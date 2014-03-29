<?php
/**
 * 共通処理用クラス
 * 本クラスでは以下の処理を行うことができる
 * オークションの残り時間を計算する。
 * 処理の詳細については各メソッドドキュメントを参照
 * 
 * @author kenji.manabe
 */
class common {
        /**
         * diffEndTime
         * オークションの終了時間を元に残り時間を計算する。
         * 精密の残り時間を計算するのではなく、日、時、分の順番に値をチェックし0以外であればその値を表示する。
         * 例
         * 残り時間が1日の場合　=> 1 日
         * 残り時間が1日以下で1時間以上の場合　=> ○ 時間
         * 残り時間が1時間以下で1分以上の場合　=> ○ 分
         * それ以外の場合　=> 1 分
         * 
         * @param string オークションの終了時間
         * @return string 残り時間
        */
        public static function diffEndTime($endTime) {
            $datetime = new DateTime($endTime);
            $nowDatetime = new DateTime();
            $interval = $datetime->diff($nowDatetime);
            $strEndTime = "";
            if ($interval->d > 0){
                $strEndTime = $interval->format('%a 日');
            }elseif($interval->h > 0){
                $strEndTime = $interval->format('%H 日');
            }elseif($interval->i > 0){        
                $strEndTime = $interval->format('%i 分');        
            }else{
                $strEndTime = $interval->format('1 分');
            }
            return $strEndTime;
        }
}
