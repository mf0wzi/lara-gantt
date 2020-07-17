<script type="application/javascript">
    var data = {!! $data !!};
    gantt.init("{!! $element !!}_gantt");
    gantt.parse(data);
</script>
