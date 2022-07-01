from flask import Flask, request, jsonify

app = Flask(__name__)

@app.route('/', methods=['GET'])
def index():
    name = request.args.get('name') # Mendapatkan variable name pada url get
    return jsonify({'name': name,})

if __name__ == '__main__':
    app.run(host="localhost", port=8001, debug=True) #menjalankan server flask pada port 8001

# akses http://localhost:8001/?name="Ipang"
# akan menampilkan data json seperti berikut:
# {
#   "name": "Ipang"
# }