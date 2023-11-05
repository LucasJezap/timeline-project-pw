<?php $is_dashboard = false; $title = 'Timeline Manager'; $links = ["welcome.css", "timeline.css", "table.css"] ?>
@include('top')
@livewire('timeline-events-table-view')
@include('bottom')
