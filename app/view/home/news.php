{{$new_title}}
<br>
{{$new_content}}
<br>
{{$new_post}}
<br>
{{ 'truong' }}
<br>
{{toSlug('pham phuoc truong')}}
<br>
{!$my_major!}
<br>
{{!empty($page_title)?$page_title:toSlug('khong co gi')}}
<br>
@if(!empty($page))  
{{$page}}
@else
khong co gi
@endif