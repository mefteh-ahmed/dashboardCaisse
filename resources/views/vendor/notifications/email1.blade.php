
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td align="center">
                <h2>{{$line}}</h2>
                </td>
<td align="center">
<a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">A<b>S</b>M Admin</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">{{ config('', 'ASM admin') }}</span>
    </a>
    </td>
</tr>
    <tr>
        <td align="center">
            <table border="0" cellpadding="0" cellspacing="0">
                <tr>
                <td align="center">
                <h2>@foreach ($introLines as $line)
{{ $introLines }}
@endforeach
</h2>
                </td>
                    <td>
                        <a href="{{ $actionUrl }}" class="button button-green" target="_blank">Send PAssword</a>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>