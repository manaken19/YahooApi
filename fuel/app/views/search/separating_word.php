<ul class="nav nav-pills">
    <?php if ($data["title_xml"] != null){ ?>
        <?php if ($data["title_xml"]->ma_result->total_count != "0" ){ ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>表記</th>
                        <th>読み仮名</th>
                        <th>品詞</th>
                    </tr>
                </thead>
                <tbody>
            <?php foreach ( $data["title_xml"]->ma_result->word_list->word as $words ){?>
                    <tr>
                        <td><?php echo strval($words->surface); ?></td>
                        <td><?php echo strval($words->reading); ?></td>
                        <td><?php echo strval($words->pos); ?></td>
                    </tr>
            <?php } ?>
                </tbody>
                </table>
        <?php } ?>
    <?php } ?>
    <?php if ($data["description_xml"] != null){ ?>
        <?php if ($data["description_xml"]->ma_result->total_count != "0" ){ ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>表記</th>
                        <th>読み仮名</th>
                        <th>品詞</th>
                    </tr>
                </thead>
                <tbody>
            <?php foreach ( $data["description_xml"]->ma_result->word_list->word as $words ){?>
                    <tr>
                        <td><?php echo strval($words->surface); ?></td>
                        <td><?php echo strval($words->reading); ?></td>
                        <td><?php echo strval($words->pos); ?></td>
                    </tr>
            <?php } ?>
                </tbody>
                </table>
        <?php } ?>
    <?php } ?>
</ul>