<?php

    class evenement {
		
		private $id;
		private $title; // description
		private $start; // datetime (Y-m-d)
		private $end; // datetime
		private $url; // lien de redirection

		public function __construct($id, $title, $start, $end, $url) { // (end et url peuvent etre null)

			$this->id = $id;
			$this->title = $title;
			$this->start = new DateTime($start);
			$this->end = new DateTime($end);
			$this->url = $url;
			
		}
		
		function getId() {
			return $this->id;
		}

		function getTitle() {
			return $this->title;
		}

		function getStart() {
			return $this->start;
		}

		function getEnd() {
			return $this->end;
		}

		function getUrl() {
			return $this->url;
		}

		// ---------------------------------------
		
		function setId($id) {
			$this->id = $id;
		}

		function setTitle($title) {
			$this->title = $title;
		}

		function setStart($start) {
			$this->start = $start;
		}

		function setEnd($end) {
			$this->end = $end;
		}

		function setUrl($url) {
			$this->url = $url;
		}
		
	}

?>