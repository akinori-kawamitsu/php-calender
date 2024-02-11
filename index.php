<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>カレンダーを出力する</title>
</head>
<body>
    <?php 
        /* 先に必要な情報を取得。 */
        date_default_timezone_set('Asia/Tokyo'); // タイムゾーン設定。
        /* 今日の日付情報 */
        $currentYear = date('Y'); // 年
        $currentMonth = date('n'); // 月(頭に0なし)
        $currentMonth0n = date('m'); // 月(頭に0あり)
        $currentDate = date('j'); // 日(頭に0なし)

        $currentFirstDate = $currentYear . "-" . $currentMonth . "-01"; // 今月頭の日付
        $currentFirstWeek = date('w', strtotime($currentFirstDate)); // 今月頭の曜日（日曜始まり、0~6で出力）
        $currentLastDate = date('d', strtotime('last day of')); // 今月の最終日
    ?>
    <div class="container">
        <h1><?php echo $currentMonth;?>月のカレンダー</h1>
        <div class="calender">
            <div class="datebox week-0 week-title">日</div>
            <div class="datebox week-1 week-title">月</div>
            <div class="datebox week-2 week-title">火</div>
            <div class="datebox week-3 week-title">水</div>
            <div class="datebox week-4 week-title">木</div>
            <div class="datebox week-5 week-title">金</div>
            <div class="datebox week-6 week-title">土</div>
            <?php
            /* 第1週、月初めまで空白ボックスを出力
               曜日番号の1個手前まで繰り返し
             */
            for ($i = 0; $i < $currentFirstWeek; $i++): 
            ?>
            <div class="datebox week-<?php echo $i;?>"></div>
            <?php endfor; /* ここまで空白ボックス */?>

            <?php 
            /* 今月の日付ボックス（1日～末尾まで）の出力 */
            $wn = $currentFirstWeek;
            for($i = 1; $i <= $currentLastDate; $i++):
                
                /* 曜日情報（0~6） */
                $wn = $wn % 7;

                /* ボックスのクラスに日付情報を付加。祝日情報などに活用する。 */
                $idate = sprintf('%02d',$i);
                $fullDate = $currentYear . "-" . $currentMonth0n . "-" . $idate;

                /* 第何曜日かの情報を付加。隔週定休日などの情報に活用する。 */
                $nweekNum = ceil((date('d', strtotime($fullDate)) - date('w', strtotime($fullDate)) - 1) / 7) + 1;
                $nweek = $nweekNum . "-" . $wn;
            ?>
            <div class="datebox date-<?php echo $fullDate;//完全な日付情報 ?> week-<?php echo $wn; //曜日情報 ?> nweek-<?php echo $nweek;?><?php if($i == $currentDate){ echo " today"; } //今日かどうか ?>">
                <div class="date"><?php echo $i;?></div>
                <div class="calenderinfo">
                    date-<?php echo $fullDate;?><br>
                    nweek-<?php echo $nweek;?><br>
                    <?php if($i == $currentDate){ echo " today"; } //今日かどうか ?>
                </div>
            </div>
            <?php $wn++;
            endfor;?>
        </div>
    </div>
</body>
</html>