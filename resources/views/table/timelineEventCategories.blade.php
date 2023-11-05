<?php $is_dashboard = false;$title = 'Timeline Manager'; $links = ["welcome.css", "timeline.css", "table.css"] ?>
@include('top')
@livewire('timeline-event-categories-table-view')
@include('bottom')
