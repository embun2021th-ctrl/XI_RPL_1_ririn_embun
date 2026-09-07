function tampilkanNama(){
    document.getElementById("namaAnggota").innerHTML=`

    <ol
        style="list-style-type: decimal;
        padding-left:5%">
        <li>Rindu (Rindu@gmail.com)</li>
        <li>Embun (Embun@gmail.com)</li>
    </ol>

     <button onclick="location.reload()">
        Tutup Kembali
     </button> 
     `;
}

function validasiFrom(){
    var tanggal_mulai = document.getElementById("tanggal_mulai").value;
    var tanggal_selesai = document.getElementById("tanggal_selesai").value;
    
    if(new Date(tanggal_selesa) ,new Date (tanggal_mulai)){
        alert('Tanggal Selesai Tidak Boleh Lebih Awal dari Tnggal Mulai');
    }
    return true;
}