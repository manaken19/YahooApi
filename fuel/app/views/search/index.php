<ul class="nav nav-pills">
    <?php echo Form::open(array('action' => 'search/index', 'method' => 'get'));?>
        <?php echo Form::input('search_item', Input::get("search_item"), array('type' => 'text', 'required' => 'required')) ?>
        <?php echo Form::submit('submit','検索',array('class' => 'btn btn-primary btn-large span7'));?>
        <?php if ($xml != null){ ?>
            <?php if ($xml->attributes()->totalResultsAvailable != "0" ){ ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>商品名</th>
                            <th>現在価格</th>
                            <th>入札数</th>
                            <th>残り時間</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                <?php foreach ( $xml->Result->Item as $item ){?>
                        <tr>
                            <td><p><?php echo Html::anchor("search/search_item?auctionID=$item->AuctionID", $item->Title); ?></p></td>
                            <td><?php echo number_format(intval($item->CurrentPrice))."円"; ?></td>
                            <td><?php echo $item->Bids; ?></td>
                            <td><?php echo Common::diffEndTime($item->EndTime); ?></td>
                            <td><p><?php echo Html::anchor("search/separating_word?auctionID=$item->AuctionID", "分かち書き"); ?></p></td>
                        </tr>
                <?php } ?>
                    </tbody>
                    </table>
                    <p>
                <?php if ($disp_pagenation["prev"] == TRUE) {?>
                    <?php echo Html::anchor("search/index?page=".strval($page - 1)."&search_item=".Input::get("search_item"), "前へ"); ?>
                <?php } ?>
                <?php if ($disp_pagenation["next"] == TRUE) {?>
                    <?php echo Html::anchor("search/index?page=".strval($page + 1)."&search_item=".Input::get("search_item"), "次へ"); ?>
                <?php } ?>
                    </p>
            <?php } ?>
        <?php } ?>
    <?php echo Form::close();?>
</ul>
