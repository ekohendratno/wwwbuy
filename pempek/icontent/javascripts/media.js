function showmedia()
{
   var n = document.form1.jumfile.value; 
   var i;
   var string = "";
   
   for (i=0; i<=n-1; i++)
   {
      string = string + "Pilih File: <input name=\"userfile"+ i + "\" type=\"file\"><br>";
   }
   
   document.getElementById('selectfile').innerHTML = string;
   document.form1.n.value = n;
}

function startUpload(){
      document.getElementById('f1_upload_process').style.visibility = 'visible';
      document.getElementById('f1_upload_form').style.visibility = 'hidden';
      return true;
}

function stopUpload(success){
      var result = '';
      if (success == 1){
         result = '<div class="div_info">The file was uploaded successfully!<\/div>';
      }
      else {
         result = '<div class="div_alert">There was an error during file upload!<\/div>';
      }
      document.getElementById('f1_upload_process').style.visibility = 'hidden';
      document.getElementById('f1_upload_form').innerHTML = result + '<label>File: <input name="myfile" type="file"/><\/label><label><input type="submit" name="submitBtn" class="i-submit" value="Upload" /><\/label>';
      document.getElementById('f1_upload_form').style.visibility = 'visible';      
      return true;   
}