<ul class="nav nav-pills">
    <?php if ($xml != null){ ?>
        <?php if (count($xml) > "0" ){ ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>項目名</th>
                        <th>値</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($xml as $key => $value){ ?>
                    <tr>
                        <td><?php echo $key; ?></td>
                        <td><?php echo $value; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } ?>
    <?php } ?>
</ul>