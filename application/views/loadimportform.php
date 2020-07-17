

<form name="uploadExcel" id="uploadExcel" enctype="multipart/form-data" onsubmit="return false;">
                                    <div class="content">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Import Excel Sheet</label>
                                                    <input type="file" id="file" name="file" >
                                                </div>
                                            </div>
                                        </div>


                                        <span id="csUpload"></span> <span id="theUpload"></span>
                                                    <button type="submit" id="uploadNow">Upload Assets</button>


                                    </div>
</form>

<script type="text/javascript">
   // var el = document.getElementById('uploadNow');
    if (el) {
        el.addEventListener("click", uploadcsv);
    }



    function uploadcsv() {

        var file = $('#file').val();
        var pbutton = $('#uploadNow').val();
        var dataString = new FormData(document.getElementById('uploadExcel')); //postArticles
        if (file == "") {
            $('#csUpload').html("Please select a CSV file to Upload");
            $('#csUpload').addClass('errorRed');
            $('#csUpload').fadeIn();
        } else {

            $.ajax({
                type: "POST",
                url: GLOBALS.appRoot + "home/csvUploadingnow",
                data: dataString,
                contentType: false,
                processData: false,
                cache: false,
                dataType: 'JSON',

                success: function (data) {
                    $('#csUpload').text('uploading assets to our Database, please wait');
                    $('#csUpload').addClass('errorRed');
                    if (data.msg) {
                        $('#csUpload').html(data.msg);
                        $('#csUpload').addClass('errorGreen');
                    }
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    console.log('An Ajax error was thrown.');
                    console.log(XMLHttpRequest);
                    console.log(textStatus);
                    console.log(errorThrown);
                }

            });

        }


    }

</script>
<?php echo $footer; ?>