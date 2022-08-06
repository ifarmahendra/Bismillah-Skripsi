import time
import mysql.connector
import pandas as pd
import warnings
import numpy as np
import string 
import re
import swifter
import sys
import os
from sklearn.metrics.pairwise import cosine_similarity, cosine_distances
from sklearn.feature_extraction.text import TfidfVectorizer
import operator
from nltk.tokenize import word_tokenize 
from nltk.probability import FreqDist
from nltk.corpus import stopwords
from Sastrawi.Stemmer.StemmerFactory import StemmerFactory

# fungsi-fungsi text processing
# Tokenezing
def remove_tweet_special(text):
    text.replace('-',' ')
    # remove tab, new line, ans back slice
    text = text.replace('\\t'," ").replace('\\u'," ").replace('\\'," ")
    # remove non ASCII (emoticon, chinese word, .etc)
    text = text.encode('ascii', 'replace').decode('ascii')
    # remove mention, link, hashtag
    text = ' '.join(re.sub("([@#][A-Za-z0-9]+)|(\w+:\/\/\S+)"," ", text).split())
    # remove incomplete URL
    text = text.replace("http://", " ").replace("https://", " ")
    return text

#remove number
def remove_number(text):
    return  re.sub(r"\d+", "", str(text))

#remove punctuation
def remove_punctuation(text):
    return text.translate(str.maketrans("","",string.punctuation))

#remove whitespace leading & trailing
def remove_whitespace_LT(text):
    return text.strip()

#remove multiple whitespace into single whitespace
def remove_whitespace_multiple(text):
    return re.sub('\s+',' ', str(text))

# remove single char
def remove_singl_char(text):
    return re.sub(r"\b[a-zA-Z]\b", "", str(text))

# NLTK word rokenize 
def word_tokenize_wrapper(text):
    return word_tokenize(text)

# ----------------------- get stopword from NLTK stopword -------------------------------
# get stopword indonesia
list_stopwords = stopwords.words('indonesian')

# read txt stopword using pandas
txt_stopword = pd.read_csv("stopword.txt", names= ["stopword"], header = None)
list_stopwords.extend(txt_stopword["stopword"][0].split(' '))

# convert list to dictionary
list_stopwords = set(list_stopwords)

#remove stopword pada list token
def stopwords_removal(words):
    return [word for word in words if word not in list_stopwords]

#normalisasi
normalizad_word = pd.read_csv("normalisasi.txt", header = None)
normalizad_word_dict = {}

for index, row in normalizad_word.iterrows():
    if row[0] not in normalizad_word_dict:
        normalizad_word_dict[row[0]] = row[1] 

def normalized_term(document):
    return [normalizad_word_dict[term] if term in normalizad_word_dict else term for term in document]

# Steeming
# create stemmer
factory = StemmerFactory()
stemmer = factory.create_stemmer()

# stemmed
def stemmed_wrapper(term):
    return stemmer.stem(term)

# apply stemmed term to dataframe
term_dict = {}
def get_stemmed_term(document):
    return [term_dict[term] for term in document]

# Fungsi baru masukkan disini (diawali dengan def blablabla)
# contoh:
# def persamaan_jawaban(jawabanuser, jawabandosen):
#     return data
# ....
# ....
# ....

def insertDfMhs(id, nama, golongan, jawaban, nilai_cosine):
    print("Insert Hasil TextProcessing Mahasiswa ID: {} ke db".format(id))
    dbConfig = mysql.connector.connect(
        host="127.0.0.1",
        user="root",
        password="Ifarmahendra99",
        database="skripsi", auth_plugin='mysql_native_password'
    )
    conn = dbConfig.cursor()
    #proses cek apakah sudah pernah diproses, jika ya maka nilai akan di update, jika tidak maka akan di create
    sql = """SELECT * FROM `hasils` WHERE `formjawaban_id` = %s""" % id
    conn.execute(sql)
    checker = conn.fetchall()

    jawaban_plain = ""
    for j in jawaban:
        jawaban_plain += j+" "
    if(checker == []):
        #create / insert ke db
        #merubah df ke json untuk dimasukkan ke db
        conn.execute("INSERT INTO `hasils`(`formjawaban_id`, `nama_mahasiswa`, `golongan`, `hasil_processing`, `nilai_cosine`) VALUES (%s,%s,%s,%s,%s)", (id, nama, golongan, jawaban_plain, float(nilai_cosine)))
        dbConfig.commit()
    else:
        # update ke db
        # merubah df ke json untuk dimasukkan ke db
        conn.execute("UPDATE hasils SET hasil_processing=%s, nilai_cosine=%s WHERE formjawaban_id=%s", (jawaban_plain, float(nilai_cosine), id))
        dbConfig.commit()

def insertDfKunci(id, kunci):
    print("Insert hasil TextProcessing Kunci Jawaban ID: {} ke db".format(id))
    dbConfig = mysql.connector.connect(
        host="127.0.0.1",
        user="root",
        password="Ifarmahendra99",
        database="skripsi", auth_plugin='mysql_native_password'
    )
    conn = dbConfig.cursor()
    #proses cek apakah sudah pernah diproses, jika ya maka nilai akan di update, jika tidak maka akan di create
    sql = """SELECT * FROM `hasils` WHERE `learningjurnal_id` = %s""" % id
    conn.execute(sql)
    checker = conn.fetchall()
    
    kunci_plain = ""
    for j in kunci:
        kunci_plain += j+" "
    if(checker == []):
        #create / insert ke db
        #merubah df ke json untuk dimasukkan ke db
        conn.execute("INSERT INTO `hasils`(`learningjurnal_id`, `hasil_processing`) VALUES (%s,%s)", (id, kunci_plain))
        dbConfig.commit()
    else:
        # update ke db
        # merubah df ke json untuk dimasukkan ke db
        conn.execute("UPDATE `hasils` SET hasil_processing=%s WHERE learningjurnal_id=%s", (kunci_plain, id))
        dbConfig.commit()

def textprocessing(df_mhs, df_kunci):
    # proses textprocessing
    #didewekno antara df jawaban mahasiswa & kunci
    df = pd.DataFrame(df_mhs[['id', 'nama', 'golongan', 'jawaban']])
    df_kunci = pd.DataFrame(df_kunci[['id', 'kunci_jawaban']])
    
    # ------ Case Folding --------
    df['jawaban'] = df['jawaban'].str.replace('-',' ').str.replace('/',' ').str.lower()
    df_kunci['kunci_jawaban'] = df_kunci['kunci_jawaban'].str.replace('-',' ').str.replace('/',' ').str.lower()

    df['jawaban'] = df['jawaban'].apply(remove_tweet_special)
    df_kunci['kunci_jawaban'] = df_kunci['kunci_jawaban'].apply(remove_tweet_special)

    df['jawaban'] = df['jawaban'].apply(remove_number)
    df_kunci['kunci_jawaban'] = df_kunci['kunci_jawaban'].apply(remove_number)

    df['jawaban'] = df['jawaban'].apply(remove_punctuation)
    df_kunci['kunci_jawaban'] = df_kunci['kunci_jawaban'].apply(remove_punctuation)

    df['jawaban'] = df['jawaban'].apply(remove_whitespace_LT)
    df_kunci['kunci_jawaban'] = df_kunci['kunci_jawaban'].apply(remove_whitespace_LT)

    df['jawaban'] = df['jawaban'].apply(remove_whitespace_multiple)
    df_kunci['kunci_jawaban'] = df_kunci['kunci_jawaban'].apply(remove_whitespace_multiple)

    df['jawaban'] = df['jawaban'].apply(remove_singl_char)
    df_kunci['kunci_jawaban'] = df_kunci['kunci_jawaban'].apply(remove_singl_char)

    #nanti sesuaikan sendiri gan, iki cek aku gampang nganune wkk
    df['hasil_tokens'] = df['jawaban'].apply(word_tokenize_wrapper)
    df_kunci['hasil_tokens'] = df_kunci['kunci_jawaban'].apply(word_tokenize_wrapper)

    df['hasil_stopword'] = df['hasil_tokens'].apply(stopwords_removal) 
    df_kunci['hasil_stopword'] = df_kunci['hasil_tokens'].apply(stopwords_removal)

    df['tweet_normalized'] = df['hasil_stopword'].apply(normalized_term)
    df_kunci['tweet_normalized'] = df_kunci['hasil_stopword'].apply(normalized_term)
    
    for document in df['tweet_normalized']:
        for term in document:
            if term not in term_dict:
                term_dict[term] = ' '
    for document in df_kunci['tweet_normalized']:
        for term in document:
            if term not in term_dict:
                term_dict[term] = ' '

    for term in term_dict:
        term_dict[term] = stemmed_wrapper(term)

    df['hasil_steeming'] = df['tweet_normalized'].swifter.apply(get_stemmed_term)
    df_kunci['hasil_steeming'] = df_kunci['tweet_normalized'].swifter.apply(get_stemmed_term)

    # insertDataMhs = df[['id', 'nama', 'golongan', 'hasil_steeming']].apply(insertDfMhs)
    # print(df[['id', 'nama', 'golongan', 'hasil_steeming']])

    
    #mentimpan ke dataset
    dataset = {}
    # untuk jawaban mhs
    for index, row in df.iterrows():
        plainData = ""
        for j in row["hasil_steeming"]:
            plainData += j+" "
        dataset['d{}'.format(index+1)] = plainData

    # untuk jawaban kunci
    for index, row in df_kunci.iterrows():
        plainData = ""
        for j in row["hasil_steeming"]:
            plainData += j+" "
        dataset['q'] = plainData
    #pembobotan TF.IDF
    tfidf = TfidfVectorizer(norm=None)
    inverted_index = tfidf.fit_transform(dataset.values())
    print(pd.DataFrame(inverted_index.toarray(), index=dataset.keys(), columns=tfidf.get_feature_names()))

    #cosine similarity
    cs = cosine_similarity(inverted_index, inverted_index)
    df_cs = pd.DataFrame(cs, index=dataset.keys(), columns=dataset.keys())
    print(df_cs)

    #pengurutan nilai
    rank_cs = {}
    for k in dataset.keys():
        if k != "q":
            rank_cs[k] = df_cs.at[k, "q"]
    top_rank_cs = dict(sorted(rank_cs.items(), key=operator.itemgetter(1), reverse=True))
    print(pd.DataFrame(top_rank_cs.values(), index=top_rank_cs.keys(), columns=["Cosine Similarity"]))

    for index, row in df.iterrows():
        insertDfMhs(row["id"], row["nama"], row["golongan"], row["hasil_steeming"], top_rank_cs['d{}'.format(index+1)])
    for index, row in df_kunci.iterrows():
        insertDfKunci(row["id"], row["hasil_steeming"])
    
    # memanggil fungsi yang telah ditambahkan diatas tadi
    # misal:
    # persamaan_jawaban(df['hasil_steeming'], df['kuncijawaban'])
    # ...
    # ...
    # ...

while True:
    try:
        # membaca daftar antrian
        with open('data/jobs.txt', 'r') as tmp:
            job = tmp.readline()
            # prosess
            if(job not in ''):
                print('Memproses job id: '+job.split('|')[0])
                # jika tidak ada jawaban yang diproses
                if len(job.split('|')[1]) == 1:
                    # anggap job selesai, hapus di jobs.txt
                    with open('data/jobs.txt', 'r') as jobs:
                        next(jobs)
                        job = jobs.read()
                        with open('data/jobs.txt', 'w') as deleteJobs:
                            deleteJobs.write(job)
                    continue
            # Konek ke db disini
            ids = job.split('|')[1]
            dbConfig = mysql.connector.connect(
                host="127.0.0.1",
                user="root",
                password="Ifarmahendra99",
                database="skripsi", auth_plugin='mysql_native_password'
            )
            conn = dbConfig.cursor()
            if(ids.count(';') > 1):
                idSoal = ids.replace(';', ',')
                conn.execute("SELECT * FROM `form_jawabans` WHERE `id` IN ("+idSoal+") GROUP BY soal_id")
            else:
                idSoal = ids.replace(';', '')
                idSoal = idSoal.replace('\n', '')
                print(idSoal)
                conn.execute("SELECT * FROM `form_jawabans` WHERE `id` = "+idSoal)
            groupSoal = conn.fetchall()
            # jika tidak ada soal
            if(groupSoal == []):
                # anggap job selesai, hapus di jobs.txt
                with open('data/jobs.txt', 'r') as jobs:
                    next(jobs)
                    job = jobs.read()
                    with open('data/jobs.txt', 'w') as deleteJobs:
                        deleteJobs.write(job)
                continue
            for soal in groupSoal:
                # mendapatkan kunci jawaban
                conn.execute("SELECT * FROM `learning_jurnals` WHERE `soal` LIKE '"+soal[7]+"' LIMIT 1")
                kunci = conn.fetchall()
                with warnings.catch_warnings():
                    warnings.simplefilter('ignore', UserWarning)
                    # dataframe jawaban kunci
                    df_kunci = pd.read_sql("SELECT * FROM `learning_jurnals` WHERE `soal` LIKE '"+soal[0]+"' LIMIT 1", dbConfig)
                    # print(df_kunci.head())
                for kunciSoal in kunci:
                    # print("SOAL: "+soal[7])
                    # print("KUNCI: "+kunciSoal[2])
                    # Kita sudah dapat Kunci jawaban, waktunya ambil jawaban mahasiswa berdasarkan soal
                    with warnings.catch_warnings():
                        warnings.simplefilter('ignore', UserWarning)
                        # dataframe jawaban mhs
                        df_jawabanMhs = pd.read_sql("SELECT * FROM `form_jawabans` WHERE `id` IN ("+idSoal+") AND `id` LIKE '"+soal[7]+"'", dbConfig)
                        # print(df_jawabanMhs.head())
                        # proses ke textprocessing
                        textprocessing(df_jawabanMhs, df_kunci)
                        print("Job "+job.split('|')[0]+" selesai diproses")

                        # anggap job selesai, hapus di jobs.txt
                        with open('data/jobs.txt', 'r') as jobs:
                            next(jobs)
                            job = jobs.read()
                            with open('data/jobs.txt', 'w') as deleteJobs:
                                deleteJobs.write(job)
    except Exception as e:
        # supaya tampilan bagus xixixixi
        # os.system('cls||clear')
        print("Menunggu Jobs")
        try:
            print(e)
        except:
            ...
    
    #limit berapa detik untuk text processing selanjutnya
    time.sleep(1)