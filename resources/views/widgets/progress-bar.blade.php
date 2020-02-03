<div class="progress">
    <div class="progress-bar bg-{{$percentage == 100 ? 'success' : ($percentage >=75 ? 'primary' : ($percentage >= 50 ? 'info' : ($percentage >= 25 ? 'warning' : 'danger')))}}" role="progressbar" style="width: {{$percentage}}%;" aria-valuenow="{{$percentage}}" aria-valuemin="0" aria-valuemax="100">{{$percentage}}%</div>
</div>
<strong class="text-{{$percentage == 100 ? 'success' : ($percentage >=75 ? 'primary' : ($percentage >= 50 ? 'info' : ($percentage >= 25 ? 'warning' : 'danger')))}}">{{$percentage == 100 ? 'Completed' : ($percentage > 0 && $percentage < 100 ? 'ongoing...' : 'Not started')}}</strong>
