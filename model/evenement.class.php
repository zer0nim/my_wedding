<?php

    class evenement {
		
		private $id;
		private $description; // description
		private $start; // datetime (Y-m-d)
		private $end; // datetime

		public function __construct($id, $description, $start, $end) { // (end et url peuvent etre null)

			$this->id = $id;
			$this->description = $description;
			$this->start = new DateTime($start);
			$this->end = new DateTime($end);
			
		}
		
		function getId() {
			return $this->id;
		}

		function getDescription() {
			return $this->description;
		}

		function getStart() {
			return $this->start;
		}

		function getEnd() {
			return $this->end;
		}

		// ---------------------------------------
		
		function setId($id) {
			$this->id = $id;
		}

		function setDescription($description) {
			$this->description = $description;
		}

		function setStart($start) {
			$this->start = $start;
		}

		function setEnd($end) {
			$this->end = $end;
		}
		
	}

?>