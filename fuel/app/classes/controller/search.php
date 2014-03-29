<?php
class Controller_Search extends Controller_Template
{
	public function action_index()
	{
		$data["subnav"] = array('index'=> 'active' );
                $data["xml"] = null;
                $data["page"] = 1;
                
                if (Input::get("page") != null){
                    $data["page"] = Input::get("page");
                }
                
                if (Input::get("search_item") != null){
                    YahooApi::search(Input::get("search_item"), $data["page"], $data);
                }
                
                $view = View::forge('search/index', $data);
                $view-> set("xml", $data["xml"], false);
                
                $this->template->title = 'ヤフオク商品検索';
		$this->template->content = $view;
	}

        public function action_search_item()
        {
                $auctionId = Input::get("auctionID");

                $data["subnav"] = array('search_item'=> 'active' );
                YahooApi::detail($auctionId, $data, TRUE);
                
                $view = View::forge('search/search_item', $data);

                $this->template->title = '検索商品詳細';
                $this->template->content = $view;
        }
        
        public function action_separating_word()
        {
                $auctionId = Input::get("auctionID");
                $data["subnav"] = array('separating_word'=> 'active' );
                YahooApi::detail($auctionId, $data);

                $data["title_xml"] = YahooApi::parse($data["xml"]->Result->Title);
                $data["description_xml"] = YahooApi::parse(strip_tags($data["xml"]->Result->Description));

                $view = View::forge('search/separating_word');
                $view-> set("data", $data, false);

                $this->template->title = '分かち書き一覧';
		$this->template->content = $view;
        }
}   
