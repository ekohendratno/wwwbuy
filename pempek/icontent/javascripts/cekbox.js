var jumlahnya;
function cekSemua(){
    jumlahnya = document.getElementById("cekAlljumlah").value;
    if(document.getElementById("cekAllbox").checked==true){
		document.getElementById("cekAllbox2").checked = true;
        for(i=0;i<jumlahnya;i++){
            idcek = "cekAllid"+i;
            idtr = "tr"+i;
            document.getElementById(idcek).checked = true;
        }
    }else{
		document.getElementById("cekAllbox2").checked = false;
        for(i=0;i<jumlahnya;i++){
            idcek = "cekAllid"+i;
            idtr = "tr"+i;
            document.getElementById(idcek).checked = false;
        }
    }
}
function cekSemua2(){
    jumlahnya = document.getElementById("cekAlljumlah").value;
    if(document.getElementById("cekAllbox2").checked==true){
		document.getElementById("cekAllbox").checked = true;
        for(i=0;i<jumlahnya;i++){
            idcek = "cekAllid"+i;
            idtr = "tr"+i;
            document.getElementById(idcek).checked = true;
        }
    }else{
		document.getElementById("cekAllbox").checked = false;
        for(i=0;i<jumlahnya;i++){
            idcek = "cekAllid"+i;
            idtr = "tr"+i;
            document.getElementById(idcek).checked = false;
        }
    }
}
function konfirmCek(){
    ada = 0;            //untuk mengecek apakah ada checkbox yang dicek
    semuanya = 1;    //untuk mengecek apakah semua checkbox tercek
    
    //untuk mengambil jumlah total checkbox yang ada
    jumlahnya = document.getElementById("cekAlljumlah").value;
    
    jumlahx = 0         //untuk mengetahui jumlah yang dicek
    for(i=0;i<jumlahnya;i++){
        idcek = "cekAllid"+i;
        if(document.getElementById(idcek).checked == true){
            jumlahx++;
            ada = 1;
        }else{
            semuanya = 0;
        }
    }
    if(ada==1){
        if(semuanya == 1){
            tanya = confirm("Are You sure delete all data?");
            if(tanya == 1){
                document.getElementById("cekAll").submit();
            }
        }else{
            tanya = confirm("Are You sure delete "+jumlahx+" item ?");
            if(tanya == 1){
                document.getElementById("cekAll").submit();
            }
        }
    }else{
		alert("Please select table fist for delete!");
	}
}