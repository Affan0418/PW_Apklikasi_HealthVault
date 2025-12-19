from flask import Flask, render_template, request, redirect, url_for, session, flash
import requests

app = Flask(__name__)
app.secret_key = 'kode_rahasia_anda'  # Pastikan ini tetap ada untuk session

# ================= AUTHENTICATION =================

@app.route('/')
def index():
    # Mengarahkan otomatis ke dashboard jika sudah login, atau ke login jika belum
    if session.get('logged_in'):
        return redirect(url_for('dashboard'))
    return redirect(url_for('login'))

@app.route('/login', methods=['GET', 'POST'])
def login():
    if request.method == 'POST':
        email = request.form.get('email')
        password = request.form.get('password')
        
        try:
            # Mengambil data user dari Laravel API
            response = requests.get('http://localhost:8000/api/users')
            users = response.json()
            
            # Cari user berdasarkan email
            user = next((u for u in users if u['email'] == email), None)
            
            # Cek User (Sederhana: password123, idealnya pakai hash check)
            if user and password == 'password123': 
                session['logged_in'] = True
                session['nama'] = user['nama']
                session['role'] = user['role']
                return redirect(url_for('dashboard'))
            else:
                flash('Email atau Password salah!')
                return redirect(url_for('login'))
        except:
            flash('Koneksi ke server Laravel gagal!')
            return redirect(url_for('login'))
            
    return render_template('login.html')

@app.route('/logout')
def logout():
    session.clear()
    return redirect(url_for('login'))

# ================= DASHBOARD =================
@app.route('/dashboard')
def dashboard():
    if not session.get('logged_in'):
        return redirect(url_for('login'))
    
    pasien = requests.get('http://localhost:8000/api/pasien').json()
    dokter = requests.get('http://localhost:8000/api/dokter').json()
    obat = requests.get('http://localhost:8000/api/obat').json()

    return render_template(
        'dashboard.html',
        total_pasien=len(pasien),
        total_dokter=len(dokter),
        total_obat=len(obat)
    )

# ================= PASIEN =================
@app.route('/pasien')
def pasien():
    if not session.get('logged_in'): return redirect(url_for('login'))
    res = requests.get('http://localhost:8000/api/pasien')
    return render_template('pasien.html', pasien=res.json())

@app.route('/pasien/tambah')
def pasien_tambah():
    if not session.get('logged_in'): return redirect(url_for('login'))
    return render_template('pasien_form.html')

@app.route('/pasien/store', methods=['POST'])
def pasien_store():
    requests.post('http://localhost:8000/api/pasien', data=request.form)
    return redirect(url_for('pasien'))

@app.route('/pasien/edit/<id>')
def pasien_edit(id):
    if not session.get('logged_in'): return redirect(url_for('login'))
    res = requests.get(f'http://localhost:8000/api/pasien/{id}')
    return render_template('pasien_form.html', pasien=res.json())

@app.route('/pasien/update/<id>', methods=['POST'])
def pasien_update(id):
    requests.put(f'http://localhost:8000/api/pasien/{id}', data=request.form)
    return redirect(url_for('pasien'))

@app.route('/pasien/hapus/<id>')
def pasien_hapus(id):
    requests.delete(f'http://localhost:8000/api/pasien/{id}')
    return redirect(url_for('pasien'))

# ================= DOKTER =================
@app.route('/dokter')
def dokter():
    if not session.get('logged_in'): return redirect(url_for('login'))
    res = requests.get('http://localhost:8000/api/dokter')
    return render_template('dokter.html', dokter=res.json())

@app.route('/dokter/tambah')
def dokter_tambah():
    if not session.get('logged_in'): return redirect(url_for('login'))
    return render_template('dokter_form.html')

@app.route('/dokter/store', methods=['POST'])
def dokter_store():
    requests.post('http://localhost:8000/api/dokter', data=request.form)
    return redirect(url_for('dokter'))

@app.route('/dokter/edit/<id>')
def dokter_edit(id):
    if not session.get('logged_in'): return redirect(url_for('login'))
    res = requests.get(f'http://localhost:8000/api/dokter/{id}')
    return render_template('dokter_form.html', dokter=res.json())

@app.route('/dokter/update/<id>', methods=['POST'])
def dokter_update(id):
    requests.put(f'http://localhost:8000/api/dokter/{id}', data=request.form)
    return redirect(url_for('dokter'))

@app.route('/dokter/hapus/<id>')
def dokter_hapus(id):
    requests.delete(f'http://localhost:8000/api/dokter/{id}')
    return redirect(url_for('dokter'))

# ================= OBAT =================
@app.route('/obat')
def obat():
    if not session.get('logged_in'): return redirect(url_for('login'))
    res = requests.get('http://localhost:8000/api/obat')
    return render_template('obat.html', obat=res.json())

@app.route('/obat/tambah')
def obat_tambah():
    if not session.get('logged_in'): return redirect(url_for('login'))
    return render_template('obat_form.html')

@app.route('/obat/store', methods=['POST'])
def obat_store():
    requests.post('http://localhost:8000/api/obat', data=request.form)
    return redirect(url_for('obat'))

@app.route('/obat/edit/<id>')
def obat_edit(id):
    if not session.get('logged_in'): return redirect(url_for('login'))
    res = requests.get(f'http://localhost:8000/api/obat/{id}')
    return render_template('obat_form.html', obat=res.json())

@app.route('/obat/update/<id>', methods=['POST'])
def obat_update(id):
    requests.put(f'http://localhost:8000/api/obat/{id}', data=request.form)
    return redirect(url_for('obat'))

@app.route('/obat/hapus/<id>')
def obat_hapus(id):
    requests.delete(f'http://localhost:8000/api/obat/{id}')
    return redirect(url_for('obat'))

# ================= RIWAYAT KUNJUNGAN =================
@app.route('/kunjungan')
def kunjungan():
    if not session.get('logged_in'): return redirect(url_for('login'))
    res = requests.get('http://localhost:8000/api/kunjungan')
    return render_template('kunjungan.html', kunjungan=res.json())

@app.route('/kunjungan/tambah')
def kunjungan_tambah():
    if not session.get('logged_in'): return redirect(url_for('login'))
    pasien = requests.get('http://localhost:8000/api/pasien').json()
    dokter = requests.get('http://localhost:8000/api/dokter').json()
    return render_template('kunjungan_form.html', pasien=pasien, dokter=dokter)

@app.route('/kunjungan/store', methods=['POST'])
def kunjungan_store():
    requests.post('http://localhost:8000/api/kunjungan', data=request.form)
    return redirect(url_for('kunjungan'))

@app.route('/kunjungan/edit/<id>')
def kunjungan_edit(id):
    if not session.get('logged_in'): return redirect(url_for('login'))
    res = requests.get(f'http://localhost:8000/api/kunjungan/{id}')
    pasien = requests.get('http://localhost:8000/api/pasien').json()
    dokter = requests.get('http://localhost:8000/api/dokter').json()
    return render_template('kunjungan_form.html', kunjungan=res.json(), pasien=pasien, dokter=dokter)

@app.route('/kunjungan/update/<id>', methods=['POST'])
def kunjungan_update(id):
    requests.put(f'http://localhost:8000/api/kunjungan/{id}', data=request.form)
    return redirect(url_for('kunjungan'))

@app.route('/kunjungan/hapus/<id>')
def kunjungan_hapus(id):
    requests.delete(f'http://localhost:8000/api/kunjungan/{id}')
    return redirect(url_for('kunjungan'))

# ================= PENGATURAN =================
@app.route('/pengaturan')
def pengaturan():
    if not session.get('logged_in'): return redirect(url_for('login'))
    # Hanya 'admin' yang boleh masuk ke menu ini
    if session.get('role') != 'admin':
        flash("Akses ditolak! Menu ini hanya untuk Admin.")
        return redirect(url_for('dashboard'))
    return render_template('pengaturan.html')

if __name__ == '__main__':
    app.run(debug=True)