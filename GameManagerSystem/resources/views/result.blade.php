<link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/styles.css') }}" rel="stylesheet">
<script src="{{ URL::asset('js/respond.min.js') }}"></script>
<script>
    window.onload = function () {
        $('#commonModal').modal('show') ;
    }
</script>
<html>
<head>
    <title></title>
</head>
<body>
<!-- Modal -->
<div class="modal fade" id="commonModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" >
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">提示</h4>
            </div>
            <div class="modal-body">
                {{ $result }}
            </div>
            <div class="modal-footer">
                <a href="{{ route($url) }}"><button type="button" class="btn btn-primary">确定</button></a>
            </div>
        </div>
    </div>
</div>
<script src="{{ URL::asset('js/jquery-1.11.1.min.js') }}"></script>
<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
</body>
</html>