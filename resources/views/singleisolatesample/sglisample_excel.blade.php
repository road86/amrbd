<html>
    <head>
    </head>
    <body>
        <table>
            <tr><th><b>SL #</b></th>
                <th><b>Sample ID</b></th>
                <th><b>Test Date</b></th>
                <th><b>Institution Name</b></th>
                <th><b>Species Name</b></th>
                <th><b>Breed Name</b></th>
                <th><b>Specimen Name</b></th>
                <th><b>Sampling Location Name</b></th>
                <th><b>Test Method Name</b></th>
                <th><b>Pathogen Name</b></th>
                <th><b>Test ID</b></th>
                <th><b>Antibiotic Name</b></th>
                <th><b>Test Result</b></th>
            </tr>

            <?php $count = 1; ?>
            @foreach($sglisample as $data)
                @foreach($data->sglisampletest as $sglisampletest)
                <tr>
                    <td>{{ $count }}</td>
                    <td>{{ $data->sample_id }}</td>
                    <td>{{ $data->test_date }}</td>
                    <td>{{ $data->institutions->institution_name }}</td>
                    <td>{{ $data->species->species_name }}</td>
                    <td>{{ $data->breed->breed_name }}</td>
                    <td>{{ $data->specimen->specimen_name }}</td>
                    <td>{{ $data->specimencollectionlocation->specimen_location_name }}</td>
                    <td>{{ $data->testmethod->test_method_name }}</td>
                    <td>{{ $data->pathogen->pathogen_name }}</td>
                    <td>{{ $sglisampletest['test_id'] }}</td>
                    <td>{{ $sglisampletest['antibiotic_id'] }}</td>
                    <td>{{ $sglisampletest['test_sensitivity_id'] }}</td>
                </tr>
                <?php $count++; ?>
                @endforeach
            @endforeach
        </table>
    </body>
</html>