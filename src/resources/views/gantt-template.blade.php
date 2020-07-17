<div id="{!! $element !!}_gantt" style="width: auto; height: {!! $size['height'] !!}px; position: relative;"></div>

<script type="application/javascript">
    let data = {!! $data !!};
    gantt.init("{!! $element !!}_gantt");
    gantt.parse(data);
</script>
