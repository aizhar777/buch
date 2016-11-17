<tr>
    <th>#{{$report->id}}</th>
    <th>{{date("d-m-Y H:i", strtotime($report->created_at))}}</th>
    <th>{{var_dump($report->toArray())}}</th>
</tr>