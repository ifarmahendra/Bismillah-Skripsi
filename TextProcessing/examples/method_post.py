from flask import Flask, request, jsonify

app = Flask(__name__)

@app.route('/', methods=['POST'])
def index():
    name = request.form['name'] # Mendapatkan variable name pada url post
    return jsonify({'name': name,})

if __name__ == '__main__':
    app.run(host="localhost", port=8001, debug=True) #menjalankan server flask pada port 8001

# untuk test, bisa pakai postman
# url http://localhost:8001 dengan method post
# pada body (form-data) nambahkan key name, dan variable terserah, misal: Ipang
# send request
# akan menampilkan data json seperti berikut:
# {
#   "name": "Ipang"
# }