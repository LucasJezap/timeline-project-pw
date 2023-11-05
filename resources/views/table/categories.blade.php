<?php $is_dashboard = false; $title = 'Timeline Manager'; $links = ["welcome.css", "timeline.css", "table.css"] ?>
@include('top')
@livewire('categories-table-view')
@include('bottom')
