@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'NCDT')
<img src="https://nso.noircontact.tech/uploads/images/beelogo.png" class="logo" alt="NCDT">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
