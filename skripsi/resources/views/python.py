import pandas as pd
import string 
import re #regex library
import swifter

# import word_tokenize & FreqDist from NLTK
from nltk.tokenize import word_tokenize 
from nltk.probability import FreqDist
from nltk.corpus import stopwords
from Sastrawi.Stemmer.StemmerFactory import StemmerFactory

def load_data():
    data = pd.read_csv('tes1.csv', delimiter =';',encoding= 'unicode_escape') #Memanggil data dari file cvs
    return data

jawaban_df = load_data()
jawaban_df.head(n=10)

df = pd.DataFrame(jawaban_df[['NAMA :', 'Perhatikan gambar berikut. Jelaskan secara rinci kondisi berdasarkan gambar di bawah ini !']])
df

# ------ Case Folding --------
df['NAMA :'] = df['NAMA :'].str.lower()
df['Perhatikan gambar berikut. Jelaskan secara rinci kondisi berdasarkan gambar di bawah ini !'] = df['Perhatikan gambar berikut. Jelaskan secara rinci kondisi berdasarkan gambar di bawah ini !'].str.lower()


df.head(n=10)

# Tokenezing

def remove_tweet_special(text):
    # remove tab, new line, ans back slice
    return text.replace('\\t'," ").replace('\\u'," ").replace('\\',"")
    # remove non ASCII (emoticon, chinese word, .etc)
    text = text.encode('ascii', 'replace').decode('ascii')
    # remove mention, link, hashtag
    text = ' '.join(re.sub("([@#][A-Za-z0-9]+)|(\w+:\/\/\S+)"," ", text).split())
    # remove incomplete URL
    return text.replace("http://", " ").replace("https://", " ")
               
df['Perhatikan gambar berikut. Jelaskan secara rinci kondisi berdasarkan gambar di bawah ini !'] = df['Perhatikan gambar berikut. Jelaskan secara rinci kondisi berdasarkan gambar di bawah ini !'].apply(remove_tweet_special)

#remove number
def remove_number(text):
    return  re.sub(r"\d+", "", str(text))

df['Perhatikan gambar berikut. Jelaskan secara rinci kondisi berdasarkan gambar di bawah ini !'] = df['Perhatikan gambar berikut. Jelaskan secara rinci kondisi berdasarkan gambar di bawah ini !'].apply(remove_number)

#remove punctuation
def remove_punctuation(text):
    return text.translate(str.maketrans("","",string.punctuation))

df['Perhatikan gambar berikut. Jelaskan secara rinci kondisi berdasarkan gambar di bawah ini !'] = df['Perhatikan gambar berikut. Jelaskan secara rinci kondisi berdasarkan gambar di bawah ini !'].apply(remove_punctuation)

#remove whitespace leading & trailing
def remove_whitespace_LT(text):
    return text.strip()

df['Perhatikan gambar berikut. Jelaskan secara rinci kondisi berdasarkan gambar di bawah ini !'] = df['Perhatikan gambar berikut. Jelaskan secara rinci kondisi berdasarkan gambar di bawah ini !'].apply(remove_whitespace_LT)

#remove multiple whitespace into single whitespace
def remove_whitespace_multiple(text):
    return re.sub('\s+',' ', str(text))

df['Perhatikan gambar berikut. Jelaskan secara rinci kondisi berdasarkan gambar di bawah ini !'] = df['Perhatikan gambar berikut. Jelaskan secara rinci kondisi berdasarkan gambar di bawah ini !'].apply(remove_whitespace_multiple)

# remove single char
def remove_singl_char(text):
    return re.sub(r"\b[a-zA-Z]\b", "", str(text))

df['Perhatikan gambar berikut. Jelaskan secara rinci kondisi berdasarkan gambar di bawah ini !'] = df['Perhatikan gambar berikut. Jelaskan secara rinci kondisi berdasarkan gambar di bawah ini !'].apply(remove_singl_char)

# NLTK word rokenize 
def word_tokenize_wrapper(text):
    return word_tokenize(text)

df['hasil_tokens'] = df['Perhatikan gambar berikut. Jelaskan secara rinci kondisi berdasarkan gambar di bawah ini !'].apply(word_tokenize_wrapper)

print('Tokenizing Result : \n') 
print(df['hasil_tokens'].head(n=10))
print('\n\n\n')

# ----------------------- get stopword from NLTK stopword -------------------------------
from nltk.corpus import stopwords
# get stopword indonesia
list_stopwords = stopwords.words('indonesian')


# ---------------------------- manualy add stopword  ------------------------------------
# append additional stopword
# list_stopwords.extend(["yg", "dg", "rt", "dgn", "ny", "d", 'klo', 
#                        'kalo', 'amp', 'biar', 'bikin', 'bilang', 
#                        'gak', 'ga', 'krn', 'nya', 'nih', 'sih', 
#                        'si', 'tau', 'tdk', 'tuh', 'utk', 'ya', 
#                        'jd', 'jgn', 'sdh', 'aja', 'n', 't', 
#                        'nyg', 'hehe', 'pen', 'u', 'nan', 'loh', 'rt',
#                        '&amp', 'yah'])

# ----------------------- add stopword from txt file ------------------------------------
# read txt stopword using pandas
txt_stopword = pd.read_csv("stopword.txt", names= ["stopword"], header = None)

list_stopwords.extend(txt_stopword["stopword"][0].split(' '))


# convert list to dictionary
list_stopwords = set(list_stopwords)

#remove stopword pada list token
def stopwords_removal(words):
    return [word for word in words if word not in list_stopwords]

df['hasil_stopword'] = df['hasil_tokens'].apply(stopwords_removal) 


print(df['hasil_stopword'].head(10))

# Steeming
# create stemmer
factory = StemmerFactory()
stemmer = factory.create_stemmer()

# stemmed
def stemmed_wrapper(term):
    return stemmer.stem(term)

term_dict = {}

for document in df['hasil_stopword']:
    for term in document:
        if term not in term_dict:
            term_dict[term] = ' '
            
# print(len(term_dict))
# print("------------------------")

for term in term_dict:
    term_dict[term] = stemmed_wrapper(term)
#     print(term,":" ,term_dict[term])
    
# print(term_dict)
# print("------------------------")


# apply stemmed term to dataframe
def get_stemmed_term(document):
    return [term_dict[term] for term in document]

df['hasil_steeming'] = df['hasil_stopword'].swifter.apply(get_stemmed_term)
print(df['hasil_steeming'].head(n=10))
