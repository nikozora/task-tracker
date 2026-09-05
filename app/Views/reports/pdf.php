<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <style>

        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
        }

        h1 {
            text-align: center;
            margin-bottom: 5px;
        }

        .period {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 7px;
            vertical-align: top;
        }

        th {
            background-color: #eeeeee;
        }

        .total {
            font-weight: bold;
        }

    </style>

</head>

<body>

    <h1>WORK ACCOMPLISHMENT REPORT</h1>

    <div class="period">

        <?= date('F d, Y', strtotime($startDate)) ?>

        -

        <?= date('F d, Y', strtotime($endDate)) ?>

    </div>


    <table>

        <thead>

            <tr>

                <th>Date</th>

                <th>Objectives</th>

                <th>Tasks Accomplished</th>

                <th>Hours Worked</th>

            </tr>

        </thead>


        <tbody>

            <?php foreach ($tasks as $task): ?>

                <?php

                    $hoursWorked = 0;

                    if (
                        $task['start_time'] &&
                        $task['end_time']
                    ) {

                        $start =
                            new DateTime($task['start_time']);

                        $end =
                            new DateTime($task['end_time']);

                        $seconds =
                            $end->getTimestamp() -
                            $start->getTimestamp();

                        $hoursWorked =
                            $seconds / 3600;
                    }

                ?>

                <tr>

                    <td>
                        <?= date(
                            'M d, Y',
                            strtotime($task['start_time'])
                        ) ?>
                    </td>

                    <td>
                        <?= esc($task['description']) ?>
                    </td>

                    <td>
                        <?= esc($task['notes']) ?>
                    </td>

                    <td>
                        <?= number_format(
                            $hoursWorked,
                            2
                        ) ?>
                    </td>

                </tr>

            <?php endforeach; ?>


            <tr class="total">

                <td colspan="3">
                    TOTAL HOURS WORKED
                </td>

                <td>
                    <?= number_format(
                        $totalHours,
                        2
                    ) ?>
                </td>

            </tr>

        </tbody>

    </table>

</body>

</html>