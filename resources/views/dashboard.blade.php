<?php $is_dashboard = true; $title = 'Timeline Manager - Dashboard'; $links = ["welcome.css", "timeline.css"] ?>
@include('top')
<!-- Begin Page Content -->
<?php $events = \App\Http\Controllers\TimelineEventController::eventList(); ?>
<div class="container py-5">
    <div class="main-timeline-4 text-white">
        <?php foreach ($events as $key => $event): ?>
        <div class="timeline-4 <?php echo $key % 2 === 0? 'left-4': 'right-4'; ?>">
            <div class="card <?php echo $key % 2 === 0? 'gradient-custom': 'gradient-custom-4'; ?>">
                <div id="timeline" class="card-body p-4">
                    <i class="fas fa-camera fa-2x mb-3"></i>
                    <h4><?= $event['event']->title ?></h4>
                    <img
                        src="{{asset('storage/' . $event['event']->image)}}"
                        onerror="this.onerror=null; this.src='{{ URL::to('images/undraw_poster.png') }}'"
                        class="img-fluid" style="max-width: 25%; max-height: 40%" alt="">
                    <p class="small text-white-50 mb-4"><?= date('M j', strtotime($event['event']->start_date)) ?>
                        - <?= date('M j', strtotime($event['event']->end_date)) ?></p>
                    <p><?= $event['event']->description ?></p>
                        <?php foreach ($event['categories'] as $category): ?>
                    <a href="{{route('getCategoryDetails', $category->id)}}"
                       class="btn-primary btn-md bg-transparent" style="border: none;"><h6
                            style="background-color: <?= $category->color ?>"
                            class="badge text-black mb-0"><?= $category->name ?></h6></a>
                    <?php endforeach; ?>
                </div>
                <a href="{{route('getEventDetails', $event['event']->id)}}"
                   class="btn btn-primary btn-md bg-transparent align-self-lg-end" style="border: none;">Details
                </a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
@include('bottom')
