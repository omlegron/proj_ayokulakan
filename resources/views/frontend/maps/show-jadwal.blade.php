<thead>
    <th colspan="2">{{ $sholat->jadwal->data->tanggal }}</th>
</thead>
<tbody>
    <tr>
        <th>Shubuh</th>
        <td style="text-align: right; color: #53c426">{{ $sholat->jadwal->data->subuh }}</td>
    </tr>
    <tr>
        <th>Duha</th>
        <td style="text-align: right; color: #53c426">{{ $sholat->jadwal->data->terbit }}</td>
    </tr>
    <tr>
        <th>Dzuhur</th>
        <td style="text-align: right; color: #53c426">{{ $sholat->jadwal->data->dzuhur }}</td>
    </tr>
    <tr>
        <th>Ashar</th>
        <td style="text-align: right; color: #53c426">{{ $sholat->jadwal->data->ashar }}</td>
    </tr>
    <tr>
        <th>Magrib</th>
        <td style="text-align: right; color: #53c426">{{ $sholat->jadwal->data->maghrib }}</td>
    </tr>
    <tr>
        <th>Isya</th>
        <td style="text-align: right; color: #53c426">{{ $sholat->jadwal->data->isya }}</td>
    </tr>
</tbody>