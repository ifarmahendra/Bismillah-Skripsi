from flask import Flask, request, jsonify
import os.path
import pandas as pd
import numpy as np
import string 
import re
import swifter
import sys
import json
import random
# import word_tokenize & FreqDist from NLTK
from nltk.tokenize import word_tokenize 
from nltk.probability import FreqDist
from nltk.corpus import stopwords
from Sastrawi.Stemmer.StemmerFactory import StemmerFactory

app = Flask(__name__)

# bulk process, atau proses berupa file csv
def load_data(fileName):
    data = pd.read_csv(fileName, delimiter =';',encoding= 'unicode_escape') #Memanggil data dari file cvs
    return data

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

@app.route('/bulk', methods=['GET'])
def bulk():
    fileCSV = request.args.get('csv') # Mendapatkan variable nama file csv pada url get
    
    # check if file not exist
    if(os.path.exists("data/"+fileCSV+".csv")) == False:
        return jsonify({
            'status': 'error',
            'message': 'File not found'
            })
    jawaban_df = load_data("data/"+fileCSV+".csv")
    df = pd.DataFrame(jawaban_df[['NAMA :', 'GOLONGAN :', 'MATA KULIAH :', 'JAWABAN MAHASISWA', 'KUNCI JAWABAN']])
    
    # ------ Case Folding --------
    df['JAWABAN MAHASISWA'] = df['JAWABAN MAHASISWA'].str.replace('-',' ').str.replace('/',' ').str.lower()
    df['KUNCI JAWABAN'] = df['KUNCI JAWABAN'].str.replace('-',' ').str.replace('/',' ').str.lower()

    df['JAWABAN MAHASISWA'] = df['JAWABAN MAHASISWA'].apply(remove_tweet_special)
    df['KUNCI JAWABAN'] = df['KUNCI JAWABAN'].apply(remove_tweet_special)

    df['JAWABAN MAHASISWA'] = df['JAWABAN MAHASISWA'].apply(remove_number)
    df['KUNCI JAWABAN'] = df['KUNCI JAWABAN'].apply(remove_number)

    df['JAWABAN MAHASISWA'] = df['JAWABAN MAHASISWA'].apply(remove_punctuation)
    df['KUNCI JAWABAN'] = df['KUNCI JAWABAN'].apply(remove_punctuation)

    df['JAWABAN MAHASISWA'] = df['JAWABAN MAHASISWA'].apply(remove_whitespace_LT)
    df['KUNCI JAWABAN'] = df['KUNCI JAWABAN'].apply(remove_whitespace_LT)

    df['JAWABAN MAHASISWA'] = df['JAWABAN MAHASISWA'].apply(remove_whitespace_multiple)
    df['KUNCI JAWABAN'] = df['KUNCI JAWABAN'].apply(remove_whitespace_multiple)

    df['JAWABAN MAHASISWA'] = df['JAWABAN MAHASISWA'].apply(remove_singl_char)
    df['KUNCI JAWABAN'] = df['KUNCI JAWABAN'].apply(remove_singl_char)

    df['hasil_tokens1'] = df['JAWABAN MAHASISWA'].apply(word_tokenize_wrapper)
    df['hasil_tokens2'] = df['KUNCI JAWABAN'].apply(word_tokenize_wrapper)

    df['hasil_stopword1'] = df['hasil_tokens1'].apply(stopwords_removal) 
    df['hasil_stopword2'] = df['hasil_tokens2'].apply(stopwords_removal)

    df['tweet_normalized1'] = df['hasil_stopword1'].apply(normalized_term)
    df['tweet_normalized2'] = df['hasil_stopword2'].apply(normalized_term)
    
    for document in df['tweet_normalized1']:
        for term in document:
            if term not in term_dict:
                term_dict[term] = ' '
                
    for document in df['tweet_normalized2']:
        for term in document:
            if term not in term_dict:
                term_dict[term] = ' '
    for term in term_dict:
        term_dict[term] = stemmed_wrapper(term)

    df['hasil_steeming1'] = df['tweet_normalized1'].swifter.apply(get_stemmed_term)
    df['hasil_steeming2'] = df['tweet_normalized2'].swifter.apply(get_stemmed_term)

   

    # memanggil fungsi yang telah ditambahkan diatas tadi
    # misal:
    # persamaan_jawaban(df['hasil_steeming'], df['kuncijawaban'])
    # ...
    # ...
    # ...

    # menjadikan data ke json untuk dilempar ke yang request api
    dfMahasiswa = df['hasil_steeming1'].to_json(orient="records")
    dfKunci = df['hasil_steeming2'].to_json(orient="records") #df['hasil_steeming'] bisa diubah dengan variable yang akan dikirim
    mahasiswa = df['NAMA :'].to_json(orient="records")
    golongan = df['GOLONGAN :'].to_json(orient="records")
    matakuliah = df['MATA KULIAH :'].to_json(orient="records")
    jawabanMahasiswa = json.loads(dfMahasiswa)
    jawabanKunci = json.loads(dfKunci)
    maha = json.loads(mahasiswa)
    gol = json.loads(golongan)
    matkul = json.loads(matakuliah)
    
    return jsonify({
        'status': 'success',
        'message': 
            {
                'nama_mahasiswa': maha,
                'golongan': gol,
                'matakuliah': matkul,
                'jawaban_mahasiswa': jawabanMahasiswa,
                'jawaban_kunci': jawabanKunci
            }
        })

@app.route('/job', methods=['GET'])
def job():
    # return request.args.get('id')
    # menyimpan ke daftar antrian
    with open('data/jobs.txt', 'a') as tmp:
        # format penulisan: id_job|id jawaban mahasiswa
        tmp.write(str(random.randint(0, 999999)) + '|' + request.args.get('id')+"\n")
    return jsonify({
        'status': 'success',
        'message': 'ID '+request.args.get('id')+' Berhasil ditambahkan ke proses penilaian !' 
        })

if __name__ == '__main__':
    app.run(port=8001, debug=True) #menjalankan server flask pada port 8001