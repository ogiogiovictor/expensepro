let message = document.getElementById('message')

const upFiles = (files) => {
   for(var x=0; x<files.length; x++){
       var fReader = new FileReader();
       var fileName = files[x].name;
       fReader.onload = function(e){
           message.innerHTML +='<br/>' + fileName;
           message.innerHTML +='<br/>' + e.target.result;
       }
       fReader.readAsText(files[x]);
   }
};

