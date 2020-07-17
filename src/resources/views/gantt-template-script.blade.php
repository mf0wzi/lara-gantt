<script type="application/javascript">
    var data = {!! $datajson !!};
        {!! $customcontroller !!}
        {!! $customfunction !!}

    gantt.init("{!! $element !!}_gantt");
    gantt.parse(data);
</script>
