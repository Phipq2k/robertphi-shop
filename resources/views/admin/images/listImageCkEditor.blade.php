<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Trình duyệt ảnh</title>
    <style type="text/css">
    .file-list{
        float: left;
        margin: 5px;
        border: 1px solid #ddd;
        padding: 10px
    }
    .file-list img{
        display: block;
        margin: 0 auto;
    }
    .file-list li:hover{
        background: cornsilk;
        cursor: pointer;
    }
    .file-list li{
        background: cornsilk;
        cursor: pointer;
        list-style-type: none;
    }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.17.1/ckeditor.js" integrity="sha512-VXEKi5eNc7ECuyIueuledlqeUWiJ7hcxBe9fnsCiVzeZ0XwJxAPemnq01/LBIBnp3i0szhvKNd9Us7fqNPsRmQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">
    $(document).ready(function(){
        var funcNum = <?php echo $_GET['CKEditorFuncNum'].';'; ?>
        $('#fileExplorer').on('click','img',function(){
            var fileURL = $(this).attr('title');
            window.opener.CKEDITOR.tools.callFunction(funcNum, fileURL);
            window.close();
        }).hover(function(){
            $(this).css('cursor','pointer');
        });
    });
    </script>
</head>
<body>
    <div id="fileExplorer">
        @foreach ($fileNames as $file)
        <div class="thumbnail">
            <ul class="file-list">
                <li>
                    <img src="{{url('storage/app/public/uploads/contents/'.$file)}}" alt="thumb" title="{{url('storage/app/public/uploads/contents/'.$file)}}" width="120" height="130">
                    <br/>
                    <span style="color:blue">{{$file}}</span>
                </li>
            </ul>
        </div>
        @endforeach
    </div>
</body>
</html>