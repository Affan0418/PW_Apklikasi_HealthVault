from flask import Flask, render_template, request, redirect, url_for
import requests


app = Flask(__name__)


API_URL = "http://127.0.0.1:8000/api"


@app.route('/')
def index():
    return render_template('index.html')


@app.route('/pasien')
def pasien():
    data = requests.get(f"{API_URL}/pasien").json()
    return render_template('pasien.html', pasien=data)


@app.route('/dokter')
def dokter():
    data = requests.get(f"{API_URL}/dokter").json()
    return render_template('dokter.html', dokter=data)


@app.route('/obat')
def obat():
    data = requests.get(f"{API_URL}/obat").json()
    return render_template('obat.html', obat=data)


@app.route('/kunjungan')
def kunjungan():
    kunjungan = requests.get(f"{API_URL}/kunjungan").json()
    pasien = requests.get(f"{API_URL}/pasien").json()
    dokter = requests.get(f"{API_URL}/dokter").json()
    return render_template('kunjungan.html', kunjungan=kunjungan, pasien=pasien, dokter=dokter)


if __name__ == '__main__':
    app.run(debug=True)