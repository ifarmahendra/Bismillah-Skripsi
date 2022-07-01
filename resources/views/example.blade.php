<table>
    @foreach($dataJawabanMhs as $jawabanMhs)
    @foreach($dataJawabanKunci as $jawabanKunci)
    <tr>
        <!-- data berupa array -->
        <td>{{print_r($jawabanMhs)}}</td>
        <td>{{print_r($jawabanKunci)}}</td>
    </tr>
    <tr>
        <!-- data berupa satuan -->
        <td>
        @foreach($jawabanMhs as $jmhs)
        {{$jmhs}},
        @endforeach
        </td>
        <td>
        @foreach($jawabanKunci as $jknc)
        {{$jknc}},
        @endforeach
        </td>
    </tr>
    @endforeach
    @endforeach
</table>
<style>
td{
    border:1px solid #000;
}
</style>