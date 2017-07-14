<?php
/**
 * This class is a part of Bookstore project
 * @author M ABD AZIZ ALFIAN <github.com/aalfiann>
 *
 * Don't remove this class unless You know what to do
 *
 */
namespace classes\bookstore;
use \classes\Auth as Auth;
use \classes\bookstore\Book as Book;
use \classes\Validation as Validation;
use \classes\CustomHandlers as CustomHandlers;
use PDO;
	/**
     * A class for book management
     *
     * @package    Bookstore
     * @author     M ABD AZIZ ALFIAN <github.com/aalfiann>
     * @copyright  Copyright (c) 2016 M ABD AZIZ ALFIAN
     * @license    https://github.com/aalfiann/reSlim/blob/master/license.md  MIT License
     */
	class Book {
        protected $db;

        var $username,$token,$authorid,$languageid,$typeid,$translatorid,$detail,$website,$statusid,$apikey,$bookid,$adminname,$reviewid,
		$submitbookid,$imagelink,$title,$description,$author,$language,$translator,$tags,$pages,$samplelink,$fulllink,$price,$search,$firstdate,$lastdate,$purpose,$publisherid,$publisher,$isbn,$released,
		$fullname,$account,$bankname,$bankaddress,$withdrawid,$frombank,$fromname,$amount,$evidence,$noreference;

		// for pagination
		var $page,$itemsPerPage;

        function __construct($db=null) {
			if (!empty($db)) {
    	        $this->db = $db;
        	}
		}

        //AUTHOR=====================================

		/** 
		 * Add new author
		 * @return result process in json encoded data
		 */
        public function addAuthor(){
            if (Auth::validToken($this->db,$this->token)){
                if (Auth::getRoleID($this->db,$this->token) == '1'){
                    $newdetail = filter_var($this->detail,FILTER_SANITIZE_STRING);
			
    			    try {
    				    $this->db->beginTransaction();
	    		    	$sql = "INSERT INTO book_author (Name) 
		        			VALUES (:detail);";
		    			$stmt = $this->db->prepare($sql);
	    				$stmt->bindParam(':detail', $newdetail, PDO::PARAM_STR);
    					if ($stmt->execute()) {
						    $data = [
					    		'status' => 'success',
				    			'code' => 'RS101',
			    				'message' => CustomHandlers::getreSlimMessage('RS101')
		    				];	
	    				} else {
    						$data = [
						    	'status' => 'error',
					    		'code' => 'RS201',
				    			'message' => CustomHandlers::getreSlimMessage('RS201')
			    			];
		    			}
	    			    $this->db->commit();
    			    } catch (PDOException $e) {
				        $data = [
    		    			'status' => 'error',
	        				'code' => $e->getCode(),
	    	    			'message' => $e->getMessage()
    			    	];
	    			    $this->db->rollBack();
    			    }
                } else {
                    $data = [
    	    			'status' => 'error',
	    				'code' => 'RS404',
            	    	'message' => CustomHandlers::getreSlimMessage('RS404')
			    	];
                }
            } else {
                $data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401')
				];
            }

			return json_encode($data, JSON_PRETTY_PRINT);
			$this->db = null;

        }

		/** 
		 * Update data author
		 * @return result process in json encoded data
		 */
        public function updateAuthor(){
            if (Auth::validToken($this->db,$this->token)){
                if (Auth::getRoleID($this->db,$this->token) == '1'){
                    $newdetail = filter_var($this->detail,FILTER_SANITIZE_STRING);
                    $newauthorid = Validation::integerOnly($this->authorid);
                    
        			try {
	        			$this->db->beginTransaction();
		        		$sql = "UPDATE book_author SET Name=:detail 
			        		WHERE AuthorID=:authorid;";
				    	$stmt = $this->db->prepare($sql);
					    $stmt->bindParam(':detail', $newdetail, PDO::PARAM_STR);
                        $stmt->bindParam(':authorid', $newauthorid, PDO::PARAM_STR);
	    				if ($stmt->execute()) {
		    				$data = [
			    				'status' => 'success',
				    			'code' => 'RS103',
					    		'message' => CustomHandlers::getreSlimMessage('RS103')
						    ];	
    					} else {
	    					$data = [
		    					'status' => 'error',
			    				'code' => 'RS203',
				    			'message' => CustomHandlers::getreSlimMessage('RS203')
					    	];
    					}
	    			    $this->db->commit();
		    	    } catch (PDOException $e) {
			    	    $data = [
    			    		'status' => 'error',
	    			    	'code' => $e->getCode(),
		    			    'message' => $e->getMessage()
    			    	];
	    			    $this->db->rollBack();
    	    		}
                } else {
                    $data = [
    	    			'status' => 'error',
	    				'code' => 'RS404',
            	    	'message' => CustomHandlers::getreSlimMessage('RS404')
			    	];
                }   
            } else {
                $data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401')
				];
            }

			return json_encode($data, JSON_PRETTY_PRINT);
			$this->db = null;

        }

		/** 
		 * Delete data author
		 * @return result process in json encoded data
		 */
        public function deleteAuthor(){
            if (Auth::validToken($this->db,$this->token)){
                if (Auth::getRoleID($this->db,$this->token) == '1'){
                    $newauthorid = Validation::integerOnly($this->authorid);
			
    			    try {
    	    			$this->db->beginTransaction();
	    	    		$sql = "DELETE FROM book_author 
		    	    		WHERE AuthorID=:authorid;";
			    		$stmt = $this->db->prepare($sql);
                        $stmt->bindParam(':authorid', $newauthorid, PDO::PARAM_STR);
					    if ($stmt->execute()) {
    						$data = [
	    						'status' => 'success',
		    					'code' => 'RS104',
			    				'message' => CustomHandlers::getreSlimMessage('RS104')
				    		];	
					    } else {
    						$data = [
	    						'status' => 'error',
		    					'code' => 'RS204',
			    				'message' => CustomHandlers::getreSlimMessage('RS204')
				    		];
					    }
    				    $this->db->commit();
        			} catch (PDOException $e) {
	        			$data = [
		        			'status' => 'error',
			        		'code' => $e->getCode(),
				        	'message' => $e->getMessage()
        				];
	        			$this->db->rollBack();
    	    		}
                } else {
                    $data = [
    	    			'status' => 'error',
	    				'code' => 'RS404',
            	    	'message' => CustomHandlers::getreSlimMessage('RS404')
			    	];
                }
            } else {
                $data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401')
				];
            }
            
			return json_encode($data, JSON_PRETTY_PRINT);
			$this->db = null;

        }

		/** 
		 * Show all data author paginated
		 * @return result process in json encoded data
		 */
        public function showAuthor(){
            if (Auth::validToken($this->db,$this->token)){
				$sql = "SELECT a.AuthorID,a.Name
					FROM book_author a
					ORDER BY a.Name ASC";
				
				$stmt = $this->db->prepare($sql);		

				if ($stmt->execute()) {	
    	    	    if ($stmt->rowCount() > 0){
        	   		   	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
						$data = [
			   	            'result' => $results, 
    	    		        'status' => 'success', 
			           	    'code' => 'RS501',
        		        	'message' => CustomHandlers::getreSlimMessage('RS501')
						];
			        } else {
        			    $data = [
            		    	'status' => 'error',
		        		    'code' => 'RS601',
        		    	    'message' => CustomHandlers::getreSlimMessage('RS601')
						];
	    	        }          	   	
				} else {
					$data = [
    	    			'status' => 'error',
						'code' => 'RS202',
	        		    'message' => CustomHandlers::getreSlimMessage('RS202')
					];
				}
			} else {
				$data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401')
				];
			}		
        
			return json_encode($data, JSON_PRETTY_PRINT);
	        $this->db= null;
        }

		/** 
		 * Search all data author paginated
		 * @return result process in json encoded data
		 */
		public function searchAuthorAsPagination() {
			if (Auth::validToken($this->db,$this->token)){
				if (Auth::getRoleID($this->db,$this->token) == '1'){
					$search = "%$this->search%";
					$sqlcountrow = "SELECT count(a.AuthorID) as TotalRow
					FROM book_author a 
					WHERE a.Name like :search
					ORDER BY a.Name ASC;";
					$stmt = $this->db->prepare($sqlcountrow);
					$stmt->bindValue(':search', $search, PDO::PARAM_STR);

					if ($stmt->execute()) {	
    	    	    	if ($stmt->rowCount() > 0){
							$single = $stmt->fetch();
						
							// Paginate won't work if page and items per page is negative.
							// So make sure that page and items per page is always return minimum zero number.
							$newpage = Validation::integerOnly($this->page);
							$newitemsperpage = Validation::integerOnly($this->itemsPerPage);
							$limits = (((($newpage-1)*$newitemsperpage) <= 0)?0:(($newpage-1)*$newitemsperpage));
							$offsets = (($newitemsperpage <= 0)?0:$newitemsperpage);

							// Query Data
							$sql = "SELECT a.AuthorID,a.Name
								FROM book_author a
								WHERE a.Name like :search
								ORDER BY a.Name ASC LIMIT :limpage , :offpage;";
							$stmt2 = $this->db->prepare($sql);
							$stmt2->bindValue(':search', $search, PDO::PARAM_STR);
							$stmt2->bindValue(':limpage', (INT) $limits, PDO::PARAM_INT);
							$stmt2->bindValue(':offpage', (INT) $offsets, PDO::PARAM_INT);
						
							if ($stmt2->execute()){
								$pagination = new \classes\Pagination();
								$pagination->totalRow = $single['TotalRow'];
								$pagination->page = $this->page;
								$pagination->itemsPerPage = $this->itemsPerPage;
								$pagination->fetchAllAssoc = $stmt2->fetchAll(PDO::FETCH_ASSOC);
								$data = $pagination->toDataArray();
							} else {
								$data = [
        	    		    		'status' => 'error',
		    	    		    	'code' => 'RS202',
	        			    	    'message' => CustomHandlers::getreSlimMessage('RS202')
								];	
							}			
				        } else {
    	    			    $data = [
        	    		    	'status' => 'error',
		    	    		    'code' => 'RS601',
        			    	    'message' => CustomHandlers::getreSlimMessage('RS601')
							];
		    	        }          	   	
					} else {
						$data = [
    	    				'status' => 'error',
							'code' => 'RS202',
	        			    'message' => CustomHandlers::getreSlimMessage('RS202')
						];
					}
				} else {
					$data = [
		    			'status' => 'error',
						'code' => 'RS404',
        		    	'message' => CustomHandlers::getreSlimMessage('RS404')
					];
				}
			} else {
				$data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401')
				];
			}		
        
			return json_encode($data, JSON_PRETTY_PRINT);
	        $this->db= null;
		}

        //LANGUAGE=====================================

		/** 
		 * Search add new language
		 * @return result process in json encoded data
		 */
        public function addLanguage(){
            if (Auth::validToken($this->db,$this->token)){
                if (Auth::getRoleID($this->db,$this->token) == '1'){
                    $newdetail = filter_var($this->detail,FILTER_SANITIZE_STRING);
			
    			    try {
        				$this->db->beginTransaction();
	        			$sql = "INSERT INTO book_language (Name) 
		        			VALUES (:detail);";
				    	$stmt = $this->db->prepare($sql);
					    $stmt->bindParam(':detail', $newdetail, PDO::PARAM_STR);
    					if ($stmt->execute()) {
	    					$data = [
		    					'status' => 'success',
			    				'code' => 'RS101',
				    			'message' => CustomHandlers::getreSlimMessage('RS101')
					    	];	
    					} else {
	    					$data = [
		    					'status' => 'error',
			    				'code' => 'RS201',
				    			'message' => CustomHandlers::getreSlimMessage('RS201')
					    	];
    					}
	    			    $this->db->commit();
		    	    } catch (PDOException $e) {
			    	    $data = [
    			    		'status' => 'error',
	    			    	'code' => $e->getCode(),
		    			    'message' => $e->getMessage()
    			    	];
	        			$this->db->rollBack();
    	    		}
                } else {
                    $data = [
    	    			'status' => 'error',
	    				'code' => 'RS404',
            	    	'message' => CustomHandlers::getreSlimMessage('RS404')
			    	];
                }
            } else {
                $data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401')
				];
            }

			return json_encode($data, JSON_PRETTY_PRINT);
			$this->db = null;
        }

		/** 
		 * Update data language
		 * @return result process in json encoded data
		 */
        public function updateLanguage(){
            if (Auth::validToken($this->db,$this->token)){
                if (Auth::getRoleID($this->db,$this->token) == '1'){
                    $newdetail = filter_var($this->detail,FILTER_SANITIZE_STRING);
                    $newlanguageid = Validation::integerOnly($this->languageid);
			
        			try {
	        			$this->db->beginTransaction();
		        		$sql = "UPDATE book_language SET Name=:detail 
			        		WHERE LanguageID=:languageid;";
					    $stmt = $this->db->prepare($sql);
    					$stmt->bindParam(':detail', $newdetail, PDO::PARAM_STR);
                        $stmt->bindParam(':languageid', $newlanguageid, PDO::PARAM_STR);
		    			if ($stmt->execute()) {
			    			$data = [
				    			'status' => 'success',
					    		'code' => 'RS103',
						    	'message' => CustomHandlers::getreSlimMessage('RS103')
    						];	
	    				} else {
		    				$data = [
			    				'status' => 'error',
				    			'code' => 'RS203',
					    		'message' => CustomHandlers::getreSlimMessage('RS203')
    						];
	    				}
		    		    $this->db->commit();
			        } catch (PDOException $e) {
				        $data = [
    				    	'status' => 'error',
	    				    'code' => $e->getCode(),
    		    			'message' => $e->getMessage()
	    		    	];
		    		    $this->db->rollBack();
    		    	}
                } else {
                    $data = [
    	    			'status' => 'error',
	    				'code' => 'RS404',
            	    	'message' => CustomHandlers::getreSlimMessage('RS404')
			    	];
                }
            } else {
                $data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401')
				];
            }

			return json_encode($data, JSON_PRETTY_PRINT);
			$this->db = null;
        }

		/** 
		 * Delete data language
		 * @return result process in json encoded data
		 */
        public function deleteLanguage(){
            if (Auth::validToken($this->db,$this->token)){
                if (Auth::getRoleID($this->db,$this->token) == '1'){
                    $newlanguageid = Validation::integerOnly($this->languageid);
			
        			try {
	        			$this->db->beginTransaction();
		        		$sql = "DELETE FROM book_language 
			        		WHERE LanguageID=:languageid;";
				    	$stmt = $this->db->prepare($sql);
                        $stmt->bindParam(':languageid', $newlanguageid, PDO::PARAM_STR);
    					if ($stmt->execute()) {
	    					$data = [
		    					'status' => 'success',
			    				'code' => 'RS104',
				    			'message' => CustomHandlers::getreSlimMessage('RS104')
					    	];	
    					} else {
	    					$data = [
		    					'status' => 'error',
			    				'code' => 'RS204',
				    			'message' => CustomHandlers::getreSlimMessage('RS204')
					    	];
    					}
	    			    $this->db->commit();
    	    		} catch (PDOException $e) {
	    	    		$data = [
		    	    		'status' => 'error',
			    	    	'code' => $e->getCode(),
				    	    'message' => $e->getMessage()
        				];
	        			$this->db->rollBack();
    	    		}
                } else {
                    $data = [
    	    			'status' => 'error',
	    				'code' => 'RS404',
            	    	'message' => CustomHandlers::getreSlimMessage('RS404')
			    	];
                }
            } else {
                $data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401')
				];
            }
            
			return json_encode($data, JSON_PRETTY_PRINT);
			$this->db = null;
        }

		/** 
		 * Show all data author paginated
		 * @return result process in json encoded data
		 */
        public function showLanguage(){
            if (Auth::validToken($this->db,$this->token)){
				$sql = "SELECT a.LanguageID,a.Name
					FROM book_language a
					ORDER BY a.Name ASC";
				
				$stmt = $this->db->prepare($sql);		

				if ($stmt->execute()) {	
    	    	    if ($stmt->rowCount() > 0){
        	   		   	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
						$data = [
			   	            'result' => $results, 
    	    		        'status' => 'success', 
			           	    'code' => 'RS501',
        		        	'message' => CustomHandlers::getreSlimMessage('RS501')
						];
			        } else {
        			    $data = [
            		    	'status' => 'error',
		        		    'code' => 'RS601',
        		    	    'message' => CustomHandlers::getreSlimMessage('RS601')
						];
	    	        }          	   	
				} else {
					$data = [
    	    			'status' => 'error',
						'code' => 'RS202',
	        		    'message' => CustomHandlers::getreSlimMessage('RS202')
					];
				}
			} else {
				$data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401')
				];
			}		
        
			return json_encode($data, JSON_PRETTY_PRINT);
	        $this->db= null;
        }

		/** 
		 * Search all data language paginated
		 * @return result process in json encoded data
		 */
		public function searchLanguageAsPagination() {
			if (Auth::validToken($this->db,$this->token)){
				if (Auth::getRoleID($this->db,$this->token) == '1'){
					$search = "%$this->search%";
					$sqlcountrow = "SELECT count(a.LanguageID) as TotalRow
					FROM book_language a
					WHERE a.Name like :search
					ORDER BY a.Name ASC;";
					$stmt = $this->db->prepare($sqlcountrow);
					$stmt->bindValue(':search', $search, PDO::PARAM_STR);

					if ($stmt->execute()) {	
    	    	    	if ($stmt->rowCount() > 0){
							$single = $stmt->fetch();
						
							// Paginate won't work if page and items per page is negative.
							// So make sure that page and items per page is always return minimum zero number.
							$newpage = Validation::integerOnly($this->page);
							$newitemsperpage = Validation::integerOnly($this->itemsPerPage);
							$limits = (((($newpage-1)*$newitemsperpage) <= 0)?0:(($newpage-1)*$newitemsperpage));
							$offsets = (($newitemsperpage <= 0)?0:$newitemsperpage);

							// Query Data
							$sql = "SELECT a.LanguageID,a.Name
								FROM book_language a
								WHERE a.Name like :search
								ORDER BY a.Name ASC LIMIT :limpage , :offpage;";
							$stmt2 = $this->db->prepare($sql);
							$stmt2->bindValue(':search', $search, PDO::PARAM_STR);
							$stmt2->bindValue(':limpage', (INT) $limits, PDO::PARAM_INT);
							$stmt2->bindValue(':offpage', (INT) $offsets, PDO::PARAM_INT);
						
							if ($stmt2->execute()){
								$pagination = new \classes\Pagination();
								$pagination->totalRow = $single['TotalRow'];
								$pagination->page = $this->page;
								$pagination->itemsPerPage = $this->itemsPerPage;
								$pagination->fetchAllAssoc = $stmt2->fetchAll(PDO::FETCH_ASSOC);
								$data = $pagination->toDataArray();
							} else {
								$data = [
        	    		    		'status' => 'error',
		    	    		    	'code' => 'RS202',
	        			    	    'message' => CustomHandlers::getreSlimMessage('RS202')
								];	
							}			
				        } else {
    	    			    $data = [
        	    		    	'status' => 'error',
		    	    		    'code' => 'RS601',
        			    	    'message' => CustomHandlers::getreSlimMessage('RS601')
							];
		    	        }          	   	
					} else {
						$data = [
    	    				'status' => 'error',
							'code' => 'RS202',
	        			    'message' => CustomHandlers::getreSlimMessage('RS202')
						];
					}
				} else {
					$data = [
		    			'status' => 'error',
						'code' => 'RS404',
        		    	'message' => CustomHandlers::getreSlimMessage('RS404')
					];
				}
			} else {
				$data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401')
				];
			}		
        
			return json_encode($data, JSON_PRETTY_PRINT);
	        $this->db= null;
		}

        //TRANSLATOR=====================================

		/** 
		 * Add new translator
		 * @return result process in json encoded data
		 */
        public function addTranslator(){
            if (Auth::validToken($this->db,$this->token)){
                if (Auth::getRoleID($this->db,$this->token) == '1'){
                    $newdetail = filter_var($this->detail,FILTER_SANITIZE_STRING);
                    $newwebsite =filter_var($this->website,FILTER_SANITIZE_STRING);
	    		    try {
    	    			$this->db->beginTransaction();
	    	    		$sql = "INSERT INTO book_translator (Name,Website) 
		    	    		VALUES (:detail,:website);";
					    $stmt = $this->db->prepare($sql);
    					$stmt->bindParam(':detail', $newdetail, PDO::PARAM_STR);
                        $stmt->bindParam(':website', $newwebsite, PDO::PARAM_STR);
		    			if ($stmt->execute()) {
			    			$data = [
				    			'status' => 'success',
					    		'code' => 'RS101',
						    	'message' => CustomHandlers::getreSlimMessage('RS101')
    						];	
	    				} else {
		    				$data = [
			    				'status' => 'error',
				    			'code' => 'RS201',
					    		'message' => CustomHandlers::getreSlimMessage('RS201')
    						];
	    				}
		    		    $this->db->commit();
			        } catch (PDOException $e) {
				        $data = [
    				    	'status' => 'error',
    	    				'code' => $e->getCode(),
	    	    			'message' => $e->getMessage()
		    	    	];
	    	    		$this->db->rollBack();
        			}
                } else {
                    $data = [
    	    			'status' => 'error',
	    				'code' => 'RS404',
            	    	'message' => CustomHandlers::getreSlimMessage('RS404')
			    	];
                }
            } else {
                $data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401')
				];
            }

			return json_encode($data, JSON_PRETTY_PRINT);
			$this->db = null;
        }

		/** 
		 * Update data translator
		 * @return result process in json encoded data
		 */
        public function updateTranslator(){
            if (Auth::validToken($this->db,$this->token)){
                if (Auth::getRoleID($this->db,$this->token) == '1'){
                    $newdetail = filter_var($this->detail,FILTER_SANITIZE_STRING);
                    $newwebsite = filter_var($this->website,FILTER_SANITIZE_STRING);
                    $newtranslatorid = Validation::integerOnly($this->translatorid);
                    
        			try {
	        			$this->db->beginTransaction();
		        		$sql = "UPDATE book_translator SET Name=:detail,Website=:website  
			        		WHERE TranslatorID=:translatorid;";
    					$stmt = $this->db->prepare($sql);
	    				$stmt->bindParam(':detail', $newdetail, PDO::PARAM_STR);
                        $stmt->bindParam(':website', $newwebsite, PDO::PARAM_STR);
                        $stmt->bindParam(':translatorid', $newtranslatorid, PDO::PARAM_STR);
				    	if ($stmt->execute()) {
					    	$data = [
						    	'status' => 'success',
    							'code' => 'RS103',
	    						'message' => CustomHandlers::getreSlimMessage('RS103')
		    				];	
			    		} else {
				    		$data = [
					    		'status' => 'error',
						    	'code' => 'RS203',
							    'message' => CustomHandlers::getreSlimMessage('RS203')
    						];
	    				}
		    		    $this->db->commit();
    			    } catch (PDOException $e) {
	    			    $data = [
    	    				'status' => 'error',
	    	    			'code' => $e->getCode(),
		    	    		'message' => $e->getMessage()
			    	    ];
    				    $this->db->rollBack();
        			}
                } else {
                    $data = [
    	    			'status' => 'error',
	    				'code' => 'RS404',
            	    	'message' => CustomHandlers::getreSlimMessage('RS404')
			    	];
                }
            } else {
                $data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401')
				];
            }

			return json_encode($data, JSON_PRETTY_PRINT);
			$this->db = null;
        }

		/** 
		 * Delete data translator
		 * @return result process in json encoded data
		 */
        public function deleteTranslator(){
            if (Auth::validToken($this->db,$this->token)){
                if (Auth::getRoleID($this->db,$this->token) == '1'){
                    $newtranslatorid = Validation::integerOnly($this->translatorid);
			
        			try {
	        			$this->db->beginTransaction();
		        		$sql = "DELETE FROM book_translator 
			        		WHERE translatorID=:translatorid;";
				    	$stmt = $this->db->prepare($sql);
                        $stmt->bindParam(':translatorid', $newtranslatorid, PDO::PARAM_STR);
    					if ($stmt->execute()) {
	    					$data = [
		    					'status' => 'success',
			    				'code' => 'RS104',
				    			'message' => CustomHandlers::getreSlimMessage('RS104')
					    	];	
    					} else {
	    					$data = [
		    					'status' => 'error',
			    				'code' => 'RS204',
				    			'message' => CustomHandlers::getreSlimMessage('RS204')
					    	];
    					}
	    			    $this->db->commit();
    	    		} catch (PDOException $e) {
	    	    		$data = [
		    	    		'status' => 'error',
			    	    	'code' => $e->getCode(),
				    	    'message' => $e->getMessage()
        				];
	        			$this->db->rollBack();
    	    		}
                } else {
                    $data = [
    	    			'status' => 'error',
	    				'code' => 'RS404',
            	    	'message' => CustomHandlers::getreSlimMessage('RS404')
			    	];
                }
            } else {
                $data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401')
				];
            }
            
			return json_encode($data, JSON_PRETTY_PRINT);
			$this->db = null;
        }

		/** 
		 * Show all data translator paginated
		 * @return result process in json encoded data
		 */
        public function showTranslator(){
            if (Auth::validToken($this->db,$this->token)){
				$sql = "SELECT a.TranslatorID,a.Name,a.Website
					FROM book_translator a
					ORDER BY a.Name ASC";
				
				$stmt = $this->db->prepare($sql);		

				if ($stmt->execute()) {	
    	    	    if ($stmt->rowCount() > 0){
        	   		   	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
						$data = [
			   	            'result' => $results, 
    	    		        'status' => 'success', 
			           	    'code' => 'RS501',
        		        	'message' => CustomHandlers::getreSlimMessage('RS501')
						];
			        } else {
        			    $data = [
            		    	'status' => 'error',
		        		    'code' => 'RS601',
        		    	    'message' => CustomHandlers::getreSlimMessage('RS601')
						];
	    	        }          	   	
				} else {
					$data = [
    	    			'status' => 'error',
						'code' => 'RS202',
	        		    'message' => CustomHandlers::getreSlimMessage('RS202')
					];
				}
			} else {
				$data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401')
				];
			}		
        
			return json_encode($data, JSON_PRETTY_PRINT);
	        $this->db= null;
        }

		/** 
		 * Search all data translator paginated
		 * @return result process in json encoded data
		 */
		public function searchTranslatorAsPagination() {
			if (Auth::validToken($this->db,$this->token)){
				if (Auth::getRoleID($this->db,$this->token) == '1'){
					$search = "%$this->search%";
					$sqlcountrow = "SELECT count(a.TranslatorID) as TotalRow
					FROM book_translator a
					WHERE a.Name like :search
					ORDER BY a.Name ASC;";
					$stmt = $this->db->prepare($sqlcountrow);
					$stmt->bindValue(':search', $search, PDO::PARAM_STR);
				
					if ($stmt->execute()) {	
    	    	    	if ($stmt->rowCount() > 0){
							$single = $stmt->fetch();
						
							// Paginate won't work if page and items per page is negative.
							// So make sure that page and items per page is always return minimum zero number.
							$newpage = Validation::integerOnly($this->page);
							$newitemsperpage = Validation::integerOnly($this->itemsPerPage);
							$limits = (((($newpage-1)*$newitemsperpage) <= 0)?0:(($newpage-1)*$newitemsperpage));
							$offsets = (($newitemsperpage <= 0)?0:$newitemsperpage);

							// Query Data
							$sql = "SELECT a.TranslatorID,a.Name,a.Website
								FROM book_translator a
								WHERE a.Name like :search
								ORDER BY a.Name ASC LIMIT :limpage , :offpage;";
							$stmt2 = $this->db->prepare($sql);
							$stmt2->bindValue(':search', $search, PDO::PARAM_STR);
							$stmt2->bindValue(':limpage', (INT) $limits, PDO::PARAM_INT);
							$stmt2->bindValue(':offpage', (INT) $offsets, PDO::PARAM_INT);
						
							if ($stmt2->execute()){
								$pagination = new \classes\Pagination();
								$pagination->totalRow = $single['TotalRow'];
								$pagination->page = $this->page;
								$pagination->itemsPerPage = $this->itemsPerPage;
								$pagination->fetchAllAssoc = $stmt2->fetchAll(PDO::FETCH_ASSOC);
								$data = $pagination->toDataArray();
							} else {
								$data = [
        	    		    		'status' => 'error',
		    	    		    	'code' => 'RS202',
	        			    	    'message' => CustomHandlers::getreSlimMessage('RS202')
								];	
							}			
				        } else {
    	    			    $data = [
        	    		    	'status' => 'error',
		    	    		    'code' => 'RS601',
        			    	    'message' => CustomHandlers::getreSlimMessage('RS601')
							];
		    	        }          	   	
					} else {
						$data = [
    	    				'status' => 'error',
							'code' => 'RS202',
	        			    'message' => CustomHandlers::getreSlimMessage('RS202')
						];
					}
				} else {
					$data = [
		    			'status' => 'error',
						'code' => 'RS404',
        		    	'message' => CustomHandlers::getreSlimMessage('RS404')
					];
				}
			} else {
				$data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401')
				];
			}		
        
			return json_encode($data, JSON_PRETTY_PRINT);
	        $this->db= null;
		}

		//BOOK TYPE=====================================

		/** 
		 * Add new type
		 * @return result process in json encoded data
		 */
        public function addType(){
            if (Auth::validToken($this->db,$this->token)){
                if (Auth::getRoleID($this->db,$this->token) == '1'){
                    $newdetail = filter_var($this->detail,FILTER_SANITIZE_STRING);
			
    			    try {
        				$this->db->beginTransaction();
	        			$sql = "INSERT INTO book_type (Name) 
		        			VALUES (:detail);";
				    	$stmt = $this->db->prepare($sql);
					    $stmt->bindParam(':detail', $newdetail, PDO::PARAM_STR);
    					if ($stmt->execute()) {
	    					$data = [
		    					'status' => 'success',
			    				'code' => 'RS101',
				    			'message' => CustomHandlers::getreSlimMessage('RS101')
					    	];	
    					} else {
	    					$data = [
		    					'status' => 'error',
			    				'code' => 'RS201',
				    			'message' => CustomHandlers::getreSlimMessage('RS201')
					    	];
    					}
	    			    $this->db->commit();
		    	    } catch (PDOException $e) {
			    	    $data = [
    			    		'status' => 'error',
	    			    	'code' => $e->getCode(),
		    			    'message' => $e->getMessage()
    			    	];
	        			$this->db->rollBack();
    	    		}
                } else {
                    $data = [
    	    			'status' => 'error',
	    				'code' => 'RS404',
            	    	'message' => CustomHandlers::getreSlimMessage('RS404')
			    	];
                }
            } else {
                $data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401')
				];
            }

			return json_encode($data, JSON_PRETTY_PRINT);
			$this->db = null;
        }

		/** 
		 * Update data type
		 * @return result process in json encoded data
		 */
        public function updateType(){
            if (Auth::validToken($this->db,$this->token)){
                if (Auth::getRoleID($this->db,$this->token) == '1'){
                    $newdetail = filter_var($this->detail,FILTER_SANITIZE_STRING);
                    $newtypeid = Validation::integerOnly($this->typeid);
			
        			try {
	        			$this->db->beginTransaction();
		        		$sql = "UPDATE book_type SET Name=:detail 
			        		WHERE TypeID=:typeid;";
					    $stmt = $this->db->prepare($sql);
    					$stmt->bindParam(':detail', $newdetail, PDO::PARAM_STR);
                        $stmt->bindParam(':typeid', $newtypeid, PDO::PARAM_STR);
		    			if ($stmt->execute()) {
			    			$data = [
				    			'status' => 'success',
					    		'code' => 'RS103',
						    	'message' => CustomHandlers::getreSlimMessage('RS103')
    						];	
	    				} else {
		    				$data = [
			    				'status' => 'error',
				    			'code' => 'RS203',
					    		'message' => CustomHandlers::getreSlimMessage('RS203')
    						];
	    				}
		    		    $this->db->commit();
			        } catch (PDOException $e) {
				        $data = [
    				    	'status' => 'error',
	    				    'code' => $e->getCode(),
    		    			'message' => $e->getMessage()
	    		    	];
		    		    $this->db->rollBack();
    		    	}
                } else {
                    $data = [
    	    			'status' => 'error',
	    				'code' => 'RS404',
            	    	'message' => CustomHandlers::getreSlimMessage('RS404')
			    	];
                }
            } else {
                $data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401')
				];
            }

			return json_encode($data, JSON_PRETTY_PRINT);
			$this->db = null;
        }

		/** 
		 * Delete data type
		 * @return result process in json encoded data
		 */
        public function deleteType(){
            if (Auth::validToken($this->db,$this->token)){
                if (Auth::getRoleID($this->db,$this->token) == '1'){
                    $newtypeid = Validation::integerOnly($this->typeid);
			
        			try {
	        			$this->db->beginTransaction();
		        		$sql = "DELETE FROM book_type 
			        		WHERE TypeID=:typeid;";
				    	$stmt = $this->db->prepare($sql);
                        $stmt->bindParam(':typeid', $newtypeid, PDO::PARAM_STR);
    					if ($stmt->execute()) {
	    					$data = [
		    					'status' => 'success',
			    				'code' => 'RS104',
				    			'message' => CustomHandlers::getreSlimMessage('RS104')
					    	];	
    					} else {
	    					$data = [
		    					'status' => 'error',
			    				'code' => 'RS204',
				    			'message' => CustomHandlers::getreSlimMessage('RS204')
					    	];
    					}
	    			    $this->db->commit();
    	    		} catch (PDOException $e) {
	    	    		$data = [
		    	    		'status' => 'error',
			    	    	'code' => $e->getCode(),
				    	    'message' => $e->getMessage()
        				];
	        			$this->db->rollBack();
    	    		}
                } else {
                    $data = [
    	    			'status' => 'error',
	    				'code' => 'RS404',
            	    	'message' => CustomHandlers::getreSlimMessage('RS404')
			    	];
                }
            } else {
                $data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401')
				];
            }
            
			return json_encode($data, JSON_PRETTY_PRINT);
			$this->db = null;
        }

		/** 
		 * Show all data type paginated
		 * @return result process in json encoded data
		 */
        public function showType(){
            if (Auth::validToken($this->db,$this->token)){
				$sql = "SELECT a.TypeID,a.Name
					FROM book_type a
					ORDER BY a.Name ASC";
				
				$stmt = $this->db->prepare($sql);		

				if ($stmt->execute()) {	
    	    	    if ($stmt->rowCount() > 0){
        	   		   	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
						$data = [
			   	            'result' => $results, 
    	    		        'status' => 'success', 
			           	    'code' => 'RS501',
        		        	'message' => CustomHandlers::getreSlimMessage('RS501')
						];
			        } else {
        			    $data = [
            		    	'status' => 'error',
		        		    'code' => 'RS601',
        		    	    'message' => CustomHandlers::getreSlimMessage('RS601')
						];
	    	        }          	   	
				} else {
					$data = [
    	    			'status' => 'error',
						'code' => 'RS202',
	        		    'message' => CustomHandlers::getreSlimMessage('RS202')
					];
				}
			} else {
				$data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401')
				];
			}		
        
			return json_encode($data, JSON_PRETTY_PRINT);
	        $this->db= null;
        }

		/** 
		 * Search all data type paginated
		 * @return result process in json encoded data
		 */
		public function searchTypeAsPagination() {
			if (Auth::validToken($this->db,$this->token)){
				if (Auth::getRoleID($this->db,$this->token) == '1'){
					$search = "%$this->search%";
					$sqlcountrow = "SELECT count(a.TypeID) as TotalRow
					FROM book_type a
					WHERE a.Name like :search
					ORDER BY a.Name ASC;";
					$stmt = $this->db->prepare($sqlcountrow);
					$stmt->bindValue(':search', $search, PDO::PARAM_STR);

					if ($stmt->execute()) {	
    	    	    	if ($stmt->rowCount() > 0){
							$single = $stmt->fetch();
						
							// Paginate won't work if page and items per page is negative.
							// So make sure that page and items per page is always return minimum zero number.
							$newpage = Validation::integerOnly($this->page);
							$newitemsperpage = Validation::integerOnly($this->itemsPerPage);
							$limits = (((($newpage-1)*$newitemsperpage) <= 0)?0:(($newpage-1)*$newitemsperpage));
							$offsets = (($newitemsperpage <= 0)?0:$newitemsperpage);

							// Query Data
							$sql = "SELECT a.TypeID,a.Name
								FROM book_type a
								WHERE a.Name like :search
								ORDER BY a.Name ASC LIMIT :limpage , :offpage;";
							$stmt2 = $this->db->prepare($sql);
							$stmt2->bindValue(':search', $search, PDO::PARAM_STR);
							$stmt2->bindValue(':limpage', (INT) $limits, PDO::PARAM_INT);
							$stmt2->bindValue(':offpage', (INT) $offsets, PDO::PARAM_INT);
						
							if ($stmt2->execute()){
								$pagination = new \classes\Pagination();
								$pagination->totalRow = $single['TotalRow'];
								$pagination->page = $this->page;
								$pagination->itemsPerPage = $this->itemsPerPage;
								$pagination->fetchAllAssoc = $stmt2->fetchAll(PDO::FETCH_ASSOC);
								$data = $pagination->toDataArray();
							} else {
								$data = [
        	    		    		'status' => 'error',
		    	    		    	'code' => 'RS202',
	        			    	    'message' => CustomHandlers::getreSlimMessage('RS202')
								];	
							}			
				        } else {
    	    			    $data = [
        	    		    	'status' => 'error',
		    	    		    'code' => 'RS601',
        			    	    'message' => CustomHandlers::getreSlimMessage('RS601')
							];
		    	        }          	   	
					} else {
						$data = [
    	    				'status' => 'error',
							'code' => 'RS202',
	        			    'message' => CustomHandlers::getreSlimMessage('RS202')
						];
					}
				} else {
					$data = [
		    			'status' => 'error',
						'code' => 'RS404',
        		    	'message' => CustomHandlers::getreSlimMessage('RS404')
					];
				}
			} else {
				$data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401')
				];
			}		
        
			return json_encode($data, JSON_PRETTY_PRINT);
	        $this->db= null;
		}

		//BOOK PUBLISHER=====================================

		/** 
		 * Add new publisher
		 * @return result process in json encoded data
		 */
        public function addPublisher(){
            if (Auth::validToken($this->db,$this->token)){
                if (Auth::getRoleID($this->db,$this->token) == '1'){
                    $newdetail = filter_var($this->detail,FILTER_SANITIZE_STRING);
			
    			    try {
        				$this->db->beginTransaction();
	        			$sql = "INSERT INTO book_publisher (Name) 
		        			VALUES (:detail);";
				    	$stmt = $this->db->prepare($sql);
					    $stmt->bindParam(':detail', $newdetail, PDO::PARAM_STR);
    					if ($stmt->execute()) {
	    					$data = [
		    					'status' => 'success',
			    				'code' => 'RS101',
				    			'message' => CustomHandlers::getreSlimMessage('RS101')
					    	];	
    					} else {
	    					$data = [
		    					'status' => 'error',
			    				'code' => 'RS201',
				    			'message' => CustomHandlers::getreSlimMessage('RS201')
					    	];
    					}
	    			    $this->db->commit();
		    	    } catch (PDOException $e) {
			    	    $data = [
    			    		'status' => 'error',
	    			    	'code' => $e->getCode(),
		    			    'message' => $e->getMessage()
    			    	];
	        			$this->db->rollBack();
    	    		}
                } else {
                    $data = [
    	    			'status' => 'error',
	    				'code' => 'RS404',
            	    	'message' => CustomHandlers::getreSlimMessage('RS404')
			    	];
                }
            } else {
                $data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401')
				];
            }

			return json_encode($data, JSON_PRETTY_PRINT);
			$this->db = null;
        }

		/** 
		 * Update data publisher
		 * @return result process in json encoded data
		 */
        public function updatePublisher(){
            if (Auth::validToken($this->db,$this->token)){
                if (Auth::getRoleID($this->db,$this->token) == '1'){
                    $newdetail = filter_var($this->detail,FILTER_SANITIZE_STRING);
                    $newpublisherid = Validation::integerOnly($this->publisherid);
			
        			try {
	        			$this->db->beginTransaction();
		        		$sql = "UPDATE book_publisher SET Name=:detail 
			        		WHERE PublisherID=:publisherid;";
					    $stmt = $this->db->prepare($sql);
    					$stmt->bindParam(':detail', $newdetail, PDO::PARAM_STR);
                        $stmt->bindParam(':publisherid', $newpublisherid, PDO::PARAM_STR);
		    			if ($stmt->execute()) {
			    			$data = [
				    			'status' => 'success',
					    		'code' => 'RS103',
						    	'message' => CustomHandlers::getreSlimMessage('RS103')
    						];	
	    				} else {
		    				$data = [
			    				'status' => 'error',
				    			'code' => 'RS203',
					    		'message' => CustomHandlers::getreSlimMessage('RS203')
    						];
	    				}
		    		    $this->db->commit();
			        } catch (PDOException $e) {
				        $data = [
    				    	'status' => 'error',
	    				    'code' => $e->getCode(),
    		    			'message' => $e->getMessage()
	    		    	];
		    		    $this->db->rollBack();
    		    	}
                } else {
                    $data = [
    	    			'status' => 'error',
	    				'code' => 'RS404',
            	    	'message' => CustomHandlers::getreSlimMessage('RS404')
			    	];
                }
            } else {
                $data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401')
				];
            }

			return json_encode($data, JSON_PRETTY_PRINT);
			$this->db = null;
        }

		/** 
		 * Delete data publisher
		 * @return result process in json encoded data
		 */
        public function deletePublisher(){
            if (Auth::validToken($this->db,$this->token)){
                if (Auth::getRoleID($this->db,$this->token) == '1'){
                    $newpublisherid = Validation::integerOnly($this->publisherid);
			
        			try {
	        			$this->db->beginTransaction();
		        		$sql = "DELETE FROM book_publisher 
			        		WHERE PublisherID=:publisherid;";
				    	$stmt = $this->db->prepare($sql);
                        $stmt->bindParam(':publisherid', $newpublisherid, PDO::PARAM_STR);
    					if ($stmt->execute()) {
	    					$data = [
		    					'status' => 'success',
			    				'code' => 'RS104',
				    			'message' => CustomHandlers::getreSlimMessage('RS104')
					    	];	
    					} else {
	    					$data = [
		    					'status' => 'error',
			    				'code' => 'RS204',
				    			'message' => CustomHandlers::getreSlimMessage('RS204')
					    	];
    					}
	    			    $this->db->commit();
    	    		} catch (PDOException $e) {
	    	    		$data = [
		    	    		'status' => 'error',
			    	    	'code' => $e->getCode(),
				    	    'message' => $e->getMessage()
        				];
	        			$this->db->rollBack();
    	    		}
                } else {
                    $data = [
    	    			'status' => 'error',
	    				'code' => 'RS404',
            	    	'message' => CustomHandlers::getreSlimMessage('RS404')
			    	];
                }
            } else {
                $data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401')
				];
            }
            
			return json_encode($data, JSON_PRETTY_PRINT);
			$this->db = null;
        }

		/** 
		 * Show all data publisher paginated
		 * @return result process in json encoded data
		 */
        public function showPublisher(){
            if (Auth::validToken($this->db,$this->token)){
				$sql = "SELECT a.PublisherID,a.Name
					FROM book_publisher a
					ORDER BY a.Name ASC";
				
				$stmt = $this->db->prepare($sql);		

				if ($stmt->execute()) {	
    	    	    if ($stmt->rowCount() > 0){
        	   		   	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
						$data = [
			   	            'result' => $results, 
    	    		        'status' => 'success', 
			           	    'code' => 'RS501',
        		        	'message' => CustomHandlers::getreSlimMessage('RS501')
						];
			        } else {
        			    $data = [
            		    	'status' => 'error',
		        		    'code' => 'RS601',
        		    	    'message' => CustomHandlers::getreSlimMessage('RS601')
						];
	    	        }          	   	
				} else {
					$data = [
    	    			'status' => 'error',
						'code' => 'RS202',
	        		    'message' => CustomHandlers::getreSlimMessage('RS202')
					];
				}
			} else {
				$data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401')
				];
			}		
        
			return json_encode($data, JSON_PRETTY_PRINT);
	        $this->db= null;
        }

		/** 
		 * Search all data publisher paginated
		 * @return result process in json encoded data
		 */
		public function searchPublisherAsPagination() {
			if (Auth::validToken($this->db,$this->token)){
				if (Auth::getRoleID($this->db,$this->token) == '1'){
					$search = "%$this->search%";
					$sqlcountrow = "SELECT count(a.PublisherID) as TotalRow
					FROM book_publisher a
					WHERE a.Name like :search
					ORDER BY a.Name ASC;";
					$stmt = $this->db->prepare($sqlcountrow);
					$stmt->bindValue(':search', $search, PDO::PARAM_STR);

					if ($stmt->execute()) {	
    	    	    	if ($stmt->rowCount() > 0){
							$single = $stmt->fetch();
						
							// Paginate won't work if page and items per page is negative.
							// So make sure that page and items per page is always return minimum zero number.
							$newpage = Validation::integerOnly($this->page);
							$newitemsperpage = Validation::integerOnly($this->itemsPerPage);
							$limits = (((($newpage-1)*$newitemsperpage) <= 0)?0:(($newpage-1)*$newitemsperpage));
							$offsets = (($newitemsperpage <= 0)?0:$newitemsperpage);

							// Query Data
							$sql = "SELECT a.PublisherID,a.Name
								FROM book_publisher a
								WHERE a.Name like :search
								ORDER BY a.Name ASC LIMIT :limpage , :offpage;";
							$stmt2 = $this->db->prepare($sql);
							$stmt2->bindValue(':search', $search, PDO::PARAM_STR);
							$stmt2->bindValue(':limpage', (INT) $limits, PDO::PARAM_INT);
							$stmt2->bindValue(':offpage', (INT) $offsets, PDO::PARAM_INT);
						
							if ($stmt2->execute()){
								$pagination = new \classes\Pagination();
								$pagination->totalRow = $single['TotalRow'];
								$pagination->page = $this->page;
								$pagination->itemsPerPage = $this->itemsPerPage;
								$pagination->fetchAllAssoc = $stmt2->fetchAll(PDO::FETCH_ASSOC);
								$data = $pagination->toDataArray();
							} else {
								$data = [
        	    		    		'status' => 'error',
		    	    		    	'code' => 'RS202',
	        			    	    'message' => CustomHandlers::getreSlimMessage('RS202')
								];	
							}			
				        } else {
    	    			    $data = [
        	    		    	'status' => 'error',
		    	    		    'code' => 'RS601',
        			    	    'message' => CustomHandlers::getreSlimMessage('RS601')
							];
		    	        }          	   	
					} else {
						$data = [
    	    				'status' => 'error',
							'code' => 'RS202',
	        			    'message' => CustomHandlers::getreSlimMessage('RS202')
						];
					}
				} else {
					$data = [
		    			'status' => 'error',
						'code' => 'RS404',
        		    	'message' => CustomHandlers::getreSlimMessage('RS404')
					];
				}
			} else {
				$data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401')
				];
			}		
        
			return json_encode($data, JSON_PRETTY_PRINT);
	        $this->db= null;
		}

		//SUBMIT BOOK=====================================

		/** 
		 * Add new submit book
		 * @return result process in json encoded data
		 */
        public function addSubmitBook(){
            if (Auth::validToken($this->db,$this->token,$this->username)){
				$newusername = strtolower(filter_var($this->username,FILTER_SANITIZE_STRING));
                $newsamplelink = filter_var($this->samplelink,FILTER_SANITIZE_STRING);
                $newfulllink = filter_var($this->fulllink,FILTER_SANITIZE_STRING);
	    	    try {
    				$this->db->beginTransaction();
		    		$sql = "INSERT INTO book_submit (Image_link,Title,Description,Author,`Language`,Translator,Tags,Pages,Sample_link,Full_link,Purpose,StatusID,Created_at,Username,Publisher,ISBN,Original_released) 
						VALUES (:imagelink,:title,:description,:author,:language,:translator,:tags,:pages,:samplelink,:fulllink,:purpose,'35',current_timestamp,:username,:publisher,:isbn,:released);";
					$stmt = $this->db->prepare($sql);
    				$stmt->bindParam(':username', $newusername, PDO::PARAM_STR);
                    $stmt->bindParam(':samplelink', $newsamplelink, PDO::PARAM_STR);
					$stmt->bindParam(':fulllink', $newfulllink, PDO::PARAM_STR);
					$stmt->bindParam(':imagelink', $this->imagelink, PDO::PARAM_STR);
					$stmt->bindParam(':title', $this->title, PDO::PARAM_STR);
					$stmt->bindParam(':description', $this->description, PDO::PARAM_STR);
					$stmt->bindParam(':author', $this->author, PDO::PARAM_STR);
					$stmt->bindParam(':language', $this->language, PDO::PARAM_STR);
					$stmt->bindParam(':translator', $this->translator, PDO::PARAM_STR);
					$stmt->bindParam(':tags', $this->tags, PDO::PARAM_STR);
					$stmt->bindParam(':pages', $this->pages, PDO::PARAM_STR);
					$stmt->bindParam(':purpose', $this->purpose, PDO::PARAM_STR);
					$stmt->bindParam(':publisher', $this->publisher, PDO::PARAM_STR);
					$stmt->bindParam(':isbn', $this->isbn, PDO::PARAM_STR);
					$stmt->bindParam(':released', $this->released, PDO::PARAM_STR);
					if ($stmt->execute()) {
			    		$data = [
				    		'status' => 'success',
				    		'code' => 'RS101',
					    	'message' => CustomHandlers::getreSlimMessage('RS101')
    					];	
					} else {
		    			$data = [
							'status' => 'error',
			    			'code' => 'RS201',
				    		'message' => CustomHandlers::getreSlimMessage('RS201')
						];
	    			}
		    	    $this->db->commit();
			    } catch (PDOException $e) {
			        $data = [
    			    	'status' => 'error',
    	    			'code' => $e->getCode(),
	    	    		'message' => $e->getMessage()
		    		];
	    			$this->db->rollBack();
        		}
            } else {
                $data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401')
				];
            }

			return json_encode($data, JSON_PRETTY_PRINT);
			$this->db = null;
        }

		/** 
		 * Update data submit book
		 * @return result process in json encoded data
		 */
        public function updateSubmitBook(){
            if (Auth::validToken($this->db,$this->token,$this->username)){
				$newusername = strtolower(filter_var($this->username,FILTER_SANITIZE_STRING));
                $newsamplelink = filter_var($this->samplelink,FILTER_SANITIZE_STRING);
                $newfulllink = filter_var($this->fulllink,FILTER_SANITIZE_STRING);
				$newsubmitbookid = Validation::integerOnly($this->submitbookid);
				$newbookid = Validation::integerOnly($this->bookid);
	    	    try {
    				$this->db->beginTransaction();
		    		$sql = "UPDATE book_submit SET Image_link=:imagelink,Title=:title,Description=:description,Author=:author,`Language`=:language,Translator=:translator,Tags=:tags,
						Pages=:pages,Sample_link=:samplelink,Full_link=:fulllink,Purpose=:purpose,StatusID=:statusid,Updated_by=:username,BookID=:bookid,Publisher=:publisher,ISBN=:isbn,Original_released=:released
						WHERE SubmitBookID=:submitbookid;";
					$stmt = $this->db->prepare($sql);
    				$stmt->bindParam(':username', $newusername, PDO::PARAM_STR);
                    $stmt->bindParam(':samplelink', $newsamplelink, PDO::PARAM_STR);
					$stmt->bindParam(':fulllink', $newfulllink, PDO::PARAM_STR);
					$stmt->bindParam(':imagelink', $this->imagelink, PDO::PARAM_STR);
					$stmt->bindParam(':title', $this->title, PDO::PARAM_STR);
					$stmt->bindParam(':description', $this->description, PDO::PARAM_STR);
					$stmt->bindParam(':author', $this->author, PDO::PARAM_STR);
					$stmt->bindParam(':language', $this->language, PDO::PARAM_STR);
					$stmt->bindParam(':translator', $this->translator, PDO::PARAM_STR);
					$stmt->bindParam(':tags', $this->tags, PDO::PARAM_STR);
					$stmt->bindParam(':pages', $this->pages, PDO::PARAM_STR);
					$stmt->bindParam(':purpose', $this->purpose, PDO::PARAM_STR);
					$stmt->bindParam(':statusid', $this->statusid, PDO::PARAM_STR);
					$stmt->bindParam(':submitbookid', $newsubmitbookid, PDO::PARAM_STR);
					$stmt->bindParam(':bookid', $newbookid, PDO::PARAM_STR);
					$stmt->bindParam(':publisher', $this->publisher, PDO::PARAM_STR);
					$stmt->bindParam(':isbn', $this->isbn, PDO::PARAM_STR);
					$stmt->bindParam(':released', $this->released, PDO::PARAM_STR);
					if ($stmt->execute()) {
			    		$data = [
				    		'status' => 'success',
				    		'code' => 'RS103',
					    	'message' => CustomHandlers::getreSlimMessage('RS103')
    					];	
					} else {
		    			$data = [
							'status' => 'error',
			    			'code' => 'RS203',
				    		'message' => CustomHandlers::getreSlimMessage('RS203')
						];
	    			}
		    	    $this->db->commit();
			    } catch (PDOException $e) {
			        $data = [
    			    	'status' => 'error',
    	    			'code' => $e->getCode(),
	    	    		'message' => $e->getMessage()
		    		];
	    			$this->db->rollBack();
        		}
            } else {
                $data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401')
				];
            }

			return json_encode($data, JSON_PRETTY_PRINT);
			$this->db = null;
        }

		/** 
		 * Delete data submit book
		 * @return result process in json encoded data
		 */
        public function deleteSubmitBook(){
            if (Auth::validToken($this->db,$this->token)){
                $newsubmitbookid = Validation::integerOnly($this->submitbookid);
			
        		try {
	        		$this->db->beginTransaction();
		        	$sql = "DELETE FROM book_submit 
			    		WHERE SubmitBookID=:submitbookid;";
			    	$stmt = $this->db->prepare($sql);
                    $stmt->bindParam(':submitbookid', $newsubmitbookid, PDO::PARAM_STR);
					if ($stmt->execute()) {
	    				$data = [
		    				'status' => 'success',
			    			'code' => 'RS104',
			    			'message' => CustomHandlers::getreSlimMessage('RS104')
				    	];	
    				} else {
	    				$data = [
		    				'status' => 'error',
			    			'code' => 'RS204',
			    			'message' => CustomHandlers::getreSlimMessage('RS204')
				    	];
    				}
    			    $this->db->commit();
    	    	} catch (PDOException $e) {
	    			$data = [
			    		'status' => 'error',
		    	    	'code' => $e->getCode(),
			    	    'message' => $e->getMessage()
        			];
	        		$this->db->rollBack();
    	    	}
            } else {
                $data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401')
				];
            }
            
			return json_encode($data, JSON_PRETTY_PRINT);
			$this->db = null;
        }

		/** 
		 * Search all data submit book paginated
		 * @return result process in json encoded data
		 */
		public function searchAllSubmitBook(){
           if (Auth::validToken($this->db,$this->token)){
			   $search = "%$this->search%";
				$newusername = strtolower($this->username);
				if (Auth::getRoleID($this->db,$this->token) == '3') {
					//count total row
					$sqlcountrow = "SELECT count(a.SubmitBookID) as TotalRow
						from book_submit a 
						inner join core_status b on a.StatusID=b.StatusID
						where a.Username=:username and a.Title like :search
						or a.Username=:username and a.Author like :search
						or a.Username=:username and a.Language like :search
						or a.Username=:username and a.Translator like :search
						or a.Username=:username and a.Publisher like :search
						or a.Username=:username and a.ISBN like :search
						or a.Username=:username and a.Tags like :search
						or a.Username=:username and a.Original_released like :search
						order by a.StatusID desc,a.Created_at desc;";
					$stmt = $this->db->prepare($sqlcountrow);		
					$stmt->bindValue(':search', $search, PDO::PARAM_STR);
					$stmt->bindParam(':username', $newusername, PDO::PARAM_STR);
				} else {
					//count total row
					$sqlcountrow = "SELECT count(a.SubmitBookID) as TotalRow
						from book_submit a 
						inner join core_status b on a.StatusID=b.StatusID
						where a.Title like :search
						or a.Author like :search
						or a.Language like :search
						or a.Translator like :search
						or a.Publisher like :search
						or a.ISBN like :search
						or a.Tags like :search
						or a.Original_released like :search
						order by a.StatusID desc,a.Created_at desc;";
					$stmt = $this->db->prepare($sqlcountrow);
					$stmt->bindValue(':search', $search, PDO::PARAM_STR);		
				}
				
				
				if ($stmt->execute()) {	
    	    		if ($stmt->rowCount() > 0){
						$single = $stmt->fetch();
						
						// Paginate won't work if page and items per page is negative.
						// So make sure that page and items per page is always return minimum zero number.
						$newpage = Validation::integerOnly($this->page);
						$newitemsperpage = Validation::integerOnly($this->itemsPerPage);
						$limits = (((($newpage-1)*$newitemsperpage) <= 0)?0:(($newpage-1)*$newitemsperpage));
						$offsets = (($newitemsperpage <= 0)?0:$newitemsperpage);

						if (Auth::getRoleID($this->db,$this->token) == '3') {
							// Query Data
							$sql = "SELECT a.SubmitBookID,a.Image_link as 'Image', a.Title,a.Description,a.Author,a.`Language`,a.Translator,a.Publisher,a.ISBN,a.Original_released,a.Tags,a.Pages,a.Sample_link,a.Full_link,a.Purpose,a.BookID,a.StatusID,b.`Status`,
								a.Created_at,a.Username,a.Updated_at,a.Updated_by
								from book_submit a 
								inner join core_status b on a.StatusID=b.StatusID
								where a.Username=:username and a.Title like :search
								or a.Username=:username and a.Author like :search
								or a.Username=:username and a.Language like :search
								or a.Username=:username and a.Translator like :search
								or a.Username=:username and a.Publisher like :search
								or a.Username=:username and a.ISBN like :search
								or a.Username=:username and a.Original_released like :search
								or a.Username=:username and a.Tags like :search
								order by a.StatusID desc,a.Created_at desc LIMIT :limpage , :offpage;";
							$stmt2 = $this->db->prepare($sql);
							$stmt2->bindValue(':search', $search, PDO::PARAM_STR);
							$stmt2->bindParam(':username', $newusername, PDO::PARAM_STR);
							$stmt2->bindValue(':limpage', (INT) $limits, PDO::PARAM_INT);
							$stmt2->bindValue(':offpage', (INT) $offsets, PDO::PARAM_INT);
						} else {
							// Query Data
							$sql = "SELECT a.SubmitBookID,a.Image_link as 'Image', a.Title,a.Description,a.Author,a.`Language`,a.Translator,a.Publisher,a.ISBN,a.Original_released,a.Tags,a.Pages,a.Sample_link,a.Full_link,a.Purpose,a.BookID,a.StatusID,b.`Status`,
								a.Created_at,a.Username,a.Updated_at,a.Updated_by
								from book_submit a 
								inner join core_status b on a.StatusID=b.StatusID
								where a.Title like :search
								or a.Author like :search
								or a.Language like :search
								or a.Translator like :search
								or a.Publisher like :search
								or a.ISBN like :search
								or a.Original_released like :search
								or a.Tags like :search
								order by a.StatusID desc,a.Created_at desc LIMIT :limpage , :offpage;";
							$stmt2 = $this->db->prepare($sql);
							$stmt2->bindValue(':search', $search, PDO::PARAM_STR);
							$stmt2->bindValue(':limpage', (INT) $limits, PDO::PARAM_INT);
							$stmt2->bindValue(':offpage', (INT) $offsets, PDO::PARAM_INT);
						}
						
							if ($stmt2->execute()){
								if ($stmt2->rowCount() > 0){
									$datares = "[";
									while($redata = $stmt2->fetch()) 
									{
										$return_arr = null;
										$names = $redata['Tags'];	
										$named = preg_split( "/[;,@#]/", $names );
										foreach($named as $name){
											if ($name != null){$return_arr[] = trim($name);}
										}

									$datares .= '{"SubmitBookID":"'.$redata['SubmitBookID'].'",
										"Title":'.json_encode($redata['Title']).',
										"Description":'.json_encode($redata['Description']).',
										"Image":'.json_encode($redata['Image']).',
										"Author":'.json_encode($redata['Author']).',
										"Language":'.json_encode($redata['Language']).',
										"Translator":'.json_encode($redata['Translator']).',
										"Tags":'.json_encode($return_arr).',
										"Pages":'.json_encode($redata['Pages']).',
										"Sample_link":'.json_encode($redata['Sample_link']).',
										"Full_link":'.json_encode($redata['Full_link']).',
										"Purpose":'.json_encode($redata['Purpose']).',
										"Publisher":'.json_encode($redata['Publisher']).',
										"ISBN":'.json_encode($redata['ISBN']).',
										"Original_released":'.json_encode($redata['Original_released']).',
										"BookID":'.json_encode($redata['BookID']).',
										"StatusID":'.json_encode($redata['StatusID']).',
										"Status":"'.$redata['Status'].'",
										"Created_at":"'.$redata['Created_at'].'",
										"Username":"'.$redata['Username'].'",
										"Updated_at":"'.$redata['Updated_at'].'",
										"Updated_by":"'.$redata['Updated_by'].'"},';
									}
									$datares = substr($datares, 0, -1);
									$datares .= "]";

									$pagination = new \classes\Pagination();
									$pagination->totalRow = $single['TotalRow'];
									$pagination->page = $this->page;
									$pagination->itemsPerPage = $this->itemsPerPage;
									$pagination->fetchAllAssoc = json_decode($datares);
									$data = $pagination->toDataArray();
								} else {
									$data = [
        	    		    			'status' => 'error',
		    	    		    		'code' => 'RS601',
		        			    	    'message' => CustomHandlers::getreSlimMessage('RS601')
									];
								}
							} else {
								$data = [
        	    		    		'status' => 'error',
		    	    		    	'code' => 'RS202',
	        			    	    'message' => CustomHandlers::getreSlimMessage('RS202')
								];	
							}			
				    } else {
    	    			$data = [
        	    			'status' => 'error',
		    	    		'code' => 'RS601',
        			    	'message' => CustomHandlers::getreSlimMessage('RS601')
						];
		    	    }          	   	
				} else {
					$data = [
    	    			'status' => 'error',
						'code' => 'RS202',
	        		    'message' => CustomHandlers::getreSlimMessage('RS202')
					];
				}
				
			} else {
				$data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401')
				];
			}		
        
			return json_encode($data, JSON_PRETTY_PRINT);
	        $this->db= null;
        }

		/** 
		 * Get all data Status for Submit Book
		 * @return result process in json encoded data
		 */
		public function showOptionSubmitBook() {
			if (Auth::validToken($this->db,$this->token)){
				$sql = "SELECT a.StatusID,a.Status
					FROM core_status a
					WHERE a.StatusID = '3' OR a.StatusID = '35' OR a.StatusID = '37'
					ORDER BY a.Status ASC";
				
				$stmt = $this->db->prepare($sql);		
				$stmt->bindParam(':token', $this->token, PDO::PARAM_STR);

				if ($stmt->execute()) {	
    	    	    if ($stmt->rowCount() > 0){
        	   		   	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
						$data = [
			   	            'result' => $results, 
    	    		        'status' => 'success', 
			           	    'code' => 'RS501',
        		        	'message' => CustomHandlers::getreSlimMessage('RS501')
						];
			        } else {
        			    $data = [
            		    	'status' => 'error',
		        		    'code' => 'RS601',
        		    	    'message' => CustomHandlers::getreSlimMessage('RS601')
						];
	    	        }          	   	
				} else {
					$data = [
    	    			'status' => 'error',
						'code' => 'RS202',
	        		    'message' => CustomHandlers::getreSlimMessage('RS202')
					];
				}
			} else {
				$data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401')
				];
			}		
        
			return json_encode($data, JSON_PRETTY_PRINT);
	        $this->db= null;
		}

		//Release BOOK=====================================

		/** 
		 * Add new release book
		 * @return result process in json encoded data
		 */
        public function addReleaseBook(){
            if (Auth::validToken($this->db,$this->token,$this->username)){
				if (Auth::getRoleID($this->db,$this->token) != '3'){
					$newusername = strtolower(filter_var($this->username,FILTER_SANITIZE_STRING));
                	$newsamplelink = filter_var($this->samplelink,FILTER_SANITIZE_STRING);
	                $newfulllink = filter_var($this->fulllink,FILTER_SANITIZE_STRING);
					$newauthorid = Validation::integerOnly($this->authorid);
					$newlanguageid = Validation::integerOnly($this->languageid);
					$newtranslatorid = Validation::integerOnly($this->translatorid);
					$newpublisherid = Validation::integerOnly($this->publisherid);
					$newtypeid = Validation::integerOnly($this->typeid);
					$newprice = Validation::integerOnly($this->price);
		    	    try {
    					$this->db->beginTransaction();
		    			$sql = "INSERT INTO book_release (Image_link,Title,Description,AuthorID,`LanguageID`,TranslatorID,TypeID,PublisherID,ISBN,Original_released,Tags,Pages,Sample_link,Full_link,Price,StatusID,Created_at,Username) 
							VALUES (:imagelink,:title,:description,:author,:language,:translator,:type,:publisher,:isbn,:released,:tags,:pages,:samplelink,:fulllink,:price,'51',current_timestamp,:username);";
						$stmt = $this->db->prepare($sql);
	    				$stmt->bindParam(':username', $newusername, PDO::PARAM_STR);
    	                $stmt->bindParam(':samplelink', $newsamplelink, PDO::PARAM_STR);
						$stmt->bindParam(':fulllink', $newfulllink, PDO::PARAM_STR);
						$stmt->bindParam(':imagelink', $this->imagelink, PDO::PARAM_STR);
						$stmt->bindParam(':title', $this->title, PDO::PARAM_STR);
						$stmt->bindParam(':description', $this->description, PDO::PARAM_STR);
						$stmt->bindParam(':author', $newauthorid, PDO::PARAM_STR);
						$stmt->bindParam(':language', $newlanguageid, PDO::PARAM_STR);
						$stmt->bindParam(':translator', $newtranslatorid, PDO::PARAM_STR);
						$stmt->bindParam(':type', $newtypeid, PDO::PARAM_STR);
						$stmt->bindParam(':publisher', $newpublisherid, PDO::PARAM_STR);
						$stmt->bindParam(':isbn', $this->isbn, PDO::PARAM_STR);
						$stmt->bindParam(':released', $this->released, PDO::PARAM_STR);
						$stmt->bindParam(':tags', $this->tags, PDO::PARAM_STR);
						$stmt->bindParam(':pages', $this->pages, PDO::PARAM_STR);
						$stmt->bindParam(':price', $newprice, PDO::PARAM_STR);
						if ($stmt->execute()) {
				    		$data = [
					    		'status' => 'success',
				    			'code' => 'RS101',
					    		'message' => CustomHandlers::getreSlimMessage('RS101')
	    					];	
						} else {
			    			$data = [
								'status' => 'error',
			    				'code' => 'RS201',
				    			'message' => CustomHandlers::getreSlimMessage('RS201')
							];
		    			}
			    	    $this->db->commit();
				    } catch (PDOException $e) {
				        $data = [
    				    	'status' => 'error',
    	    				'code' => $e->getCode(),
		    	    		'message' => $e->getMessage()
			    		];
	    				$this->db->rollBack();
        			}
				} else {
					$data = [
    	    			'status' => 'error',
	    				'code' => 'RS404',
            	    	'message' => CustomHandlers::getreSlimMessage('RS404')
			    	];
				}
            } else {
                $data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401')
				];
            }

			return json_encode($data, JSON_PRETTY_PRINT);
			$this->db = null;
        }

		/** 
		 * Update data release book
		 * @return result process in json encoded data
		 */
        public function updateReleaseBook(){
            if (Auth::validToken($this->db,$this->token)){
				if (Auth::getRoleID($this->db,$this->token) != '3'){
					$newusername = strtolower(filter_var($this->username,FILTER_SANITIZE_STRING));
	                $newsamplelink = filter_var($this->samplelink,FILTER_SANITIZE_STRING);
    	            $newfulllink = filter_var($this->fulllink,FILTER_SANITIZE_STRING);
					$newauthorid = Validation::integerOnly($this->authorid);
					$newlanguageid = Validation::integerOnly($this->languageid);
					$newtranslatorid = Validation::integerOnly($this->translatorid);
					$newpublisherid = Validation::integerOnly($this->publisherid);
					$newtypeid = Validation::integerOnly($this->typeid);
					$newbookid = Validation::integerOnly($this->bookid);
					$newprice = Validation::integerOnly($this->price);

		    	    try {
    					$this->db->beginTransaction();
			    		$sql = "UPDATE book_release SET Image_link=:imagelink,Title=:title,Description=:description,AuthorID=:author,`LanguageID`=:language,TranslatorID=:translator,TypeID=:type,
								Tags=:tags,Pages=:pages,Sample_link=:samplelink,Full_link=:fulllink,Price=:price,StatusID=:statusid,Updated_by=:username,PublisherID=:publisher,ISBN=:isbn,Original_released=:released
							WHERE BookID=:bookid;";
						$stmt = $this->db->prepare($sql);
    					$stmt->bindParam(':username', $newusername, PDO::PARAM_STR);
                	    $stmt->bindParam(':samplelink', $newsamplelink, PDO::PARAM_STR);
						$stmt->bindParam(':fulllink', $newfulllink, PDO::PARAM_STR);
						$stmt->bindParam(':imagelink', $this->imagelink, PDO::PARAM_STR);
						$stmt->bindParam(':title', $this->title, PDO::PARAM_STR);
						$stmt->bindParam(':description', $this->description, PDO::PARAM_STR);
						$stmt->bindParam(':author', $newauthorid, PDO::PARAM_STR);
						$stmt->bindParam(':language', $newlanguageid, PDO::PARAM_STR);
						$stmt->bindParam(':translator', $newtranslatorid, PDO::PARAM_STR);
						$stmt->bindParam(':type', $newtypeid, PDO::PARAM_STR);
						$stmt->bindParam(':publisher', $newpublisherid, PDO::PARAM_STR);
						$stmt->bindParam(':isbn', $this->isbn, PDO::PARAM_STR);
						$stmt->bindParam(':released', $this->released, PDO::PARAM_STR);
						$stmt->bindParam(':tags', $this->tags, PDO::PARAM_STR);
						$stmt->bindParam(':pages', $this->pages, PDO::PARAM_STR);
						$stmt->bindParam(':statusid', $this->statusid, PDO::PARAM_STR);
						$stmt->bindParam(':bookid', $newbookid, PDO::PARAM_STR);
						$stmt->bindParam(':price', $newprice, PDO::PARAM_STR);
						if ($stmt->execute()) {
				    		$data = [
					    		'status' => 'success',
				    			'code' => 'RS103',
					    		'message' => CustomHandlers::getreSlimMessage('RS103')
	    					];	
						} else {
			    			$data = [
								'status' => 'error',
			    				'code' => 'RS203',
				    			'message' => CustomHandlers::getreSlimMessage('RS203')
							];
		    			}
			    	    $this->db->commit();
				    } catch (PDOException $e) {
				        $data = [
    				    	'status' => 'error',
    	    				'code' => $e->getCode(),
	    	    			'message' => $e->getMessage()
			    		];
		    			$this->db->rollBack();
        			}
				} else {
					$data = [
    	    			'status' => 'error',
	    				'code' => 'RS404',
            	    	'message' => CustomHandlers::getreSlimMessage('RS404')
			    	];
				}
            } else {
                $data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401')
				];
            }

			return json_encode($data, JSON_PRETTY_PRINT);
			$this->db = null;
        }

		/** 
		 * Delete data release book
		 * @return result process in json encoded data
		 */
        public function deleteReleaseBook(){
            if (Auth::validToken($this->db,$this->token)){
				if (Auth::getRoleID($this->db,$this->token) != '3'){
					$newbookid = Validation::integerOnly($this->bookid);
			
	        		try {
		        		$this->db->beginTransaction();
			        	$sql = "DELETE FROM book_release 
				    		WHERE BookID=:bookid;";
			    		$stmt = $this->db->prepare($sql);
                    	$stmt->bindParam(':bookid', $newsubmitbookid, PDO::PARAM_STR);
						if ($stmt->execute()) {
		    				$data = [
			    				'status' => 'success',
				    			'code' => 'RS104',
			    				'message' => CustomHandlers::getreSlimMessage('RS104')
				    		];	
	    				} else {
		    				$data = [
			    				'status' => 'error',
				    			'code' => 'RS204',
			    				'message' => CustomHandlers::getreSlimMessage('RS204')
				    		];
	    				}
    				    $this->db->commit();
    		    	} catch (PDOException $e) {
	    				$data = [
			    			'status' => 'error',
		    	    		'code' => $e->getCode(),
			    	    	'message' => $e->getMessage()
	        			];
		        		$this->db->rollBack();
    		    	}
				} else {
					$data = [
    	    			'status' => 'error',
	    				'code' => 'RS404',
            	    	'message' => CustomHandlers::getreSlimMessage('RS404')
			    	];
				}
            } else {
                $data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401')
				];
            }
            
			return json_encode($data, JSON_PRETTY_PRINT);
			$this->db = null;
        }

		/** 
		 * Show data release book only single detail for guest without login
		 * @return result process in json encoded data
		 */
		public function showSingleReleaseBook(){
            $newbookid = Validation::integerOnly($this->bookid);
				
				$sql = "SELECT a.BookID,a.Image_link as 'Image', a.Title,a.Description,a.AuthorID,c.Name as 'Author',a.`LanguageID`,d.Name as 'Language',a.TranslatorID,e.Name as 'Translator',
							e.Website as 'Translator_web',a.`TypeID`,f.Name as 'Type',a.PublisherID,g.Name as 'Publisher',a.ISBN,a.Original_released,a.Tags,a.Pages,a.Sample_link,a.Price,a.StatusID,b.`Status`,
							a.Created_at,a.Username,a.Updated_at,a.Updated_by
						from book_release a 
						inner join core_status b on a.StatusID=b.StatusID
						inner join book_author c on a.AuthorID=c.AuthorID
						inner join book_language d on a.LanguageID=d.LanguageID
						inner join book_translator e on a.TranslatorID=e.TranslatorID
						inner join book_type f on a.TypeID=f.TypeID
						inner join book_publisher g on a.PublisherID=g.PublisherID
						where a.StatusID='51' and a.BookID=:bookid
						order by a.Created_at asc";
				
				$stmt = $this->db->prepare($sql);		
				$stmt->bindParam(':bookid', $newbookid, PDO::PARAM_STR);

				if ($stmt->execute()) {	
    	    	    if ($stmt->rowCount() > 0){
        	   		   	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
						$data = [
			   	            'result' => $results, 
    	    		        'status' => 'success', 
			           	    'code' => 'RS501',
        		        	'message' => CustomHandlers::getreSlimMessage('RS501')
						];
			        } else {
        			    $data = [
            		    	'status' => 'error',
		        		    'code' => 'RS601',
        		    	    'message' => CustomHandlers::getreSlimMessage('RS601')
						];
	    	        }          	   	
				} else {
					$data = [
    	    			'status' => 'error',
						'code' => 'RS202',
	        		    'message' => CustomHandlers::getreSlimMessage('RS202')
					];
				}	
        
			return json_encode($data, JSON_PRETTY_PRINT);
	        $this->db= null;
        }

		/** 
		 * Show all data published release book paginated for guest without login paginated
		 * @return result process in json encoded data
		 */
		public function showPublishReleaseBook(){
			$search = "%$this->search%";
			//count total row
			$sqlcountrow = "SELECT count(a.BookID) as TotalRow
				from book_release a 
				inner join core_status b on a.StatusID=b.StatusID
				inner join book_author c on a.AuthorID=c.AuthorID
				inner join book_language d on a.LanguageID=d.LanguageID
				inner join book_translator e on a.TranslatorID=e.TranslatorID
				inner join book_type f on a.TypeID=f.TypeID
				inner join book_publisher g on a.PublisherID=g.PublisherID
				where a.StatusID='51' and a.BookID like :search
				or a.StatusID='51' and a.Title like :search
				or a.StatusID='51' and c.Name like :search
				or a.StatusID='51' and d.Name like :search
				or a.StatusID='51' and e.Name like :search
				or a.StatusID='51' and f.Name like :search
				or a.StatusID='51' and g.Name like :search
				or a.StatusID='51' and a.ISBN like :search
				or a.StatusID='51' and a.Original_released like :search
				or a.StatusID='51' and a.Tags like :search
				order by a.Created_at desc;";
			$stmt = $this->db->prepare($sqlcountrow);
			$stmt->bindValue(':search', $search, PDO::PARAM_STR);

			if ($stmt->execute()) {	
    	   		if ($stmt->rowCount() > 0){
					$single = $stmt->fetch();
					
					// Paginate won't work if page and items per page is negative.
					// So make sure that page and items per page is always return minimum zero number.
					$newpage = Validation::integerOnly($this->page);
					$newitemsperpage = Validation::integerOnly($this->itemsPerPage);
					$limits = (((($newpage-1)*$newitemsperpage) <= 0)?0:(($newpage-1)*$newitemsperpage));
					$offsets = (($newitemsperpage <= 0)?0:$newitemsperpage);

					// Query Data
					$sql = "SELECT a.BookID,a.Image_link as 'Image', a.Title,a.Description,a.AuthorID,c.Name as 'Author',a.`LanguageID`,d.Name as 'Language',a.TranslatorID,e.Name as 'Translator',
							e.Website as 'Translator_web',a.`TypeID`,f.Name as 'Type',a.PublisherID,g.Name as 'Publisher',a.ISBN,a.Original_released,a.Tags,a.Pages,a.Sample_link,a.Price,a.StatusID,b.`Status`,
							a.Created_at,a.Username,a.Updated_at,a.Updated_by
						from book_release a 
						inner join core_status b on a.StatusID=b.StatusID
						inner join book_author c on a.AuthorID=c.AuthorID
						inner join book_language d on a.LanguageID=d.LanguageID
						inner join book_translator e on a.TranslatorID=e.TranslatorID
						inner join book_type f on a.TypeID=f.TypeID
						inner join book_publisher g on a.PublisherID=g.PublisherID
						where a.StatusID='51' and a.BookID like :search
						or a.StatusID='51' and a.Title like :search
						or a.StatusID='51' and c.Name like :search
						or a.StatusID='51' and d.Name like :search
						or a.StatusID='51' and e.Name like :search
						or a.StatusID='51' and f.Name like :search
						or a.StatusID='51' and g.Name like :search
						or a.StatusID='51' and a.ISBN like :search
						or a.StatusID='51' and a.Original_released like :search
						or a.StatusID='51' and a.Tags like :search
						order by a.Created_at desc LIMIT :limpage , :offpage;";
					$stmt2 = $this->db->prepare($sql);
					$stmt2->bindValue(':search', $search, PDO::PARAM_STR);
					$stmt2->bindValue(':limpage', (INT) $limits, PDO::PARAM_INT);
					$stmt2->bindValue(':offpage', (INT) $offsets, PDO::PARAM_INT);
						
					if ($stmt2->execute()){
						if ($stmt2->rowCount() > 0){
							$datares = "[";
							while($redata = $stmt2->fetch()) 
							{
								$return_arr = null;
								$names = $redata['Tags'];	
								$named = preg_split( "/[;,@#]/", $names );
								foreach($named as $name){
									if ($name != null){$return_arr[] = trim($name);}
							}
								$sample = explode("/", $redata['Sample_link']);
							$datares .= '{"BookID":"'.$redata['BookID'].'",
								"Title":'.json_encode($redata['Title']).',
								"Description":'.json_encode($redata['Description']).',
								"Image":'.json_encode($redata['Image']).',
								"AuthorID":'.json_encode($redata['AuthorID']).',
								"Author":'.json_encode($redata['Author']).',
								"LanguageID":'.json_encode($redata['LanguageID']).',
								"Language":'.json_encode($redata['Language']).',
								"TranslatorID":'.json_encode($redata['TranslatorID']).',
								"Translator":'.json_encode($redata['Translator']).',
								"Translator_web":'.json_encode($redata['Translator_web']).',
								"TypeID":'.json_encode($redata['TypeID']).',
								"Type":'.json_encode($redata['Type']).',
								"PublisherID":'.json_encode($redata['PublisherID']).',
								"Publisher":'.json_encode($redata['Publisher']).',
								"ISBN":'.json_encode($redata['ISBN']).',
								"Original_released":'.json_encode($redata['Original_released']).',
								"Tags":'.json_encode($return_arr).',
								"Pages":'.json_encode($redata['Pages']).',
								"Sample_link":'.json_encode($redata['Sample_link']).',
								"Sample_file":'.json_encode(end($sample)).',
								"Price":'.json_encode($redata['Price']).',
								"StatusID":'.json_encode($redata['StatusID']).',
								"Status":"'.$redata['Status'].'",
								"Created_at":"'.$redata['Created_at'].'",
								"Username":"'.$redata['Username'].'",
								"Updated_at":"'.$redata['Updated_at'].'",
								"Updated_by":"'.$redata['Updated_by'].'"},';
							}
							$datares = substr($datares, 0, -1);
							$datares .= "]";
							$pagination = new \classes\Pagination();
							$pagination->totalRow = $single['TotalRow'];
							$pagination->page = $this->page;
							$pagination->itemsPerPage = $this->itemsPerPage;
							$pagination->fetchAllAssoc = json_decode($datares);
							$data = $pagination->toDataArray();
						} else {
							$data = [
   	    		    			'status' => 'error',
	    	    		    	'code' => 'RS601',
	        			        'message' => CustomHandlers::getreSlimMessage('RS601')
							];
						}
					} else {
						$data = [
       			    		'status' => 'error',
		    		    	'code' => 'RS202',
    			    	    'message' => CustomHandlers::getreSlimMessage('RS202')
						];	
					}			
			    } else {
   	    			$data = [
       	    			'status' => 'error',
	    	    		'code' => 'RS601',
       			    	'message' => CustomHandlers::getreSlimMessage('RS601')
					];
	    	    }          	   	
			} else {
				$data = [
   	    			'status' => 'error',
					'code' => 'RS202',
        		    'message' => CustomHandlers::getreSlimMessage('RS202')
				];
			}		
        
			return json_encode($data, JSON_PRETTY_PRINT);
	        $this->db= null;
        }

		/** 
		 * Search all data publish release book in Showroom
		 * @return result process in json encoded data
		 */
		public function searchPublishReleaseBookShowroom(){
			if (Auth::validToken($this->db,$this->token,$this->username)){
				$newusername = strtolower(filter_var($this->username,FILTER_SANITIZE_STRING));
				$search = "%$this->search%";
				//count total row
				$sqlcountrow = "SELECT count(a.BookID) as TotalRow
					from book_release a 
					inner join core_status b on a.StatusID=b.StatusID
					inner join book_author c on a.AuthorID=c.AuthorID
					inner join book_language d on a.LanguageID=d.LanguageID
					inner join book_translator e on a.TranslatorID=e.TranslatorID
					inner join book_type f on a.TypeID=f.TypeID
					left join book_library g on a.BookID=g.BookID and g.Username=:username
					inner join book_publisher h on a.PublisherID=h.PublisherID
					where a.StatusID='51' and g.BookID is null and c.Name like :search
					or a.StatusID='51' and g.BookID is null and d.Name like :search
					or a.StatusID='51' and g.BookID is null and e.Name like :search
					or a.StatusID='51' and g.BookID is null and f.Name like :search
					or a.StatusID='51' and g.BookID is null and h.Name like :search
					or a.StatusID='51' and g.BookID is null and a.ISBN like :search
					or a.StatusID='51' and g.BookID is null and a.Original_released like :search
					or a.StatusID='51' and g.BookID is null and a.Tags like :search
					or a.StatusID='51' and g.BookID is null and a.Title like :search
					order by a.Created_at desc;";
				$stmt = $this->db->prepare($sqlcountrow);
				$stmt->bindValue(':username', $newusername, PDO::PARAM_STR);
				$stmt->bindValue(':search', $search, PDO::PARAM_STR);

				if ($stmt->execute()) {	
    	   			if ($stmt->rowCount() > 0){
						$single = $stmt->fetch();
					
						// Paginate won't work if page and items per page is negative.
						// So make sure that page and items per page is always return minimum zero number.
						$newpage = Validation::integerOnly($this->page);
						$newitemsperpage = Validation::integerOnly($this->itemsPerPage);
						$limits = (((($newpage-1)*$newitemsperpage) <= 0)?0:(($newpage-1)*$newitemsperpage));
						$offsets = (($newitemsperpage <= 0)?0:$newitemsperpage);
						
						// Query Data
						$sql = "SELECT a.BookID,a.Image_link as 'Image', a.Title,a.Description,a.AuthorID,c.Name as 'Author',a.`LanguageID`,d.Name as 'Language',a.TranslatorID,e.Name as 'Translator',
								e.Website as 'Translator_web',a.`TypeID`,f.Name as 'Type',a.PublisherID,h.Name as 'Publisher',a.ISBN,a.Original_released,a.Tags,a.Pages,a.Sample_link,a.Price,a.StatusID,b.`Status`,
								a.Created_at,a.Username,a.Updated_at,a.Updated_by
							from book_release a 
							inner join core_status b on a.StatusID=b.StatusID
							inner join book_author c on a.AuthorID=c.AuthorID
							inner join book_language d on a.LanguageID=d.LanguageID
							inner join book_translator e on a.TranslatorID=e.TranslatorID
							inner join book_type f on a.TypeID=f.TypeID
							left join book_library g on a.BookID=g.BookID and g.Username=:username
							inner join book_publisher h on a.PublisherID=h.PublisherID
							where a.StatusID='51' and g.BookID is null and c.Name like :search
							or a.StatusID='51' and g.BookID is null and d.Name like :search
							or a.StatusID='51' and g.BookID is null and e.Name like :search
							or a.StatusID='51' and g.BookID is null and f.Name like :search
							or a.StatusID='51' and g.BookID is null and h.Name like :search
							or a.StatusID='51' and g.BookID is null and a.ISBN like :search
							or a.StatusID='51' and g.BookID is null and a.Original_released like :search
							or a.StatusID='51' and g.BookID is null and a.Tags like :search
							or a.StatusID='51' and g.BookID is null and a.Title like :search
							order by a.Created_at desc LIMIT :limpage , :offpage;";
						$stmt2 = $this->db->prepare($sql);
						$stmt2->bindValue(':search', $search, PDO::PARAM_STR);
						$stmt2->bindValue(':username', $newusername, PDO::PARAM_STR);
						$stmt2->bindValue(':limpage', (INT) $limits, PDO::PARAM_INT);
						$stmt2->bindValue(':offpage', (INT) $offsets, PDO::PARAM_INT);

						if ($stmt2->execute()){
							if ($stmt2->rowCount() > 0){
								$datares = "[";
								while($redata = $stmt2->fetch()) 
								{
									$return_arr = null;
									$names = $redata['Tags'];	
									$named = preg_split( "/[;,@#]/", $names );
									foreach($named as $name){
										if ($name != null){$return_arr[] = trim($name);}
								}
								
									$sample = explode("/", $redata['Sample_link']);
								$datares .= '{"BookID":"'.$redata['BookID'].'",
									"Title":'.json_encode($redata['Title']).',
									"Description":'.json_encode($redata['Description']).',
									"Image":'.json_encode($redata['Image']).',
									"AuthorID":'.json_encode($redata['AuthorID']).',
									"Author":'.json_encode($redata['Author']).',
									"LanguageID":'.json_encode($redata['LanguageID']).',
									"Language":'.json_encode($redata['Language']).',
									"TranslatorID":'.json_encode($redata['TranslatorID']).',
									"Translator":'.json_encode($redata['Translator']).',
									"Translator_web":'.json_encode($redata['Translator_web']).',
									"TypeID":'.json_encode($redata['TypeID']).',
									"Type":'.json_encode($redata['Type']).',
									"PublisherID":'.json_encode($redata['PublisherID']).',
									"Publisher":'.json_encode($redata['Publisher']).',
									"ISBN":'.json_encode($redata['ISBN']).',
									"Original_released":'.json_encode($redata['Original_released']).',
									"Tags":'.json_encode($return_arr).',
									"Pages":'.json_encode($redata['Pages']).',
									"Sample_link":'.json_encode($redata['Sample_link']).',
									"Sample_file":'.json_encode(end($sample)).',
									"Price":'.json_encode($redata['Price']).',
									"StatusID":'.json_encode($redata['StatusID']).',
									"Status":"'.$redata['Status'].'",
									"Created_at":"'.$redata['Created_at'].'",
									"Username":"'.$redata['Username'].'",
									"Updated_at":"'.$redata['Updated_at'].'",
									"Updated_by":"'.$redata['Updated_by'].'"},';
								}
								$datares = substr($datares, 0, -1);
								$datares .= "]";
								$pagination = new \classes\Pagination();
								$pagination->totalRow = $single['TotalRow'];
								$pagination->page = $this->page;
								$pagination->itemsPerPage = $this->itemsPerPage;
								$pagination->fetchAllAssoc = json_decode($datares);
								$data = $pagination->toDataArray();
							} else {
								$data = [
   	    			    			'status' => 'error',
	    	    			    	'code' => 'RS601',
	        				        'message' => CustomHandlers::getreSlimMessage('RS601')
								];
							}
						} else {
							$data = [
       				    		'status' => 'error',
		    			    	'code' => 'RS202',
    			    		    'message' => CustomHandlers::getreSlimMessage('RS202')
							];	
						}			
				    } else {
   	    				$data = [
       	    				'status' => 'error',
	    	    			'code' => 'RS601',
       			    		'message' => CustomHandlers::getreSlimMessage('RS601')
						];
		    	    }          	   	
				} else {
					$data = [
   	    				'status' => 'error',
						'code' => 'RS202',
        		    	'message' => CustomHandlers::getreSlimMessage('RS202')
					];
				}	
			} else {
				$data = [
   	    			'status' => 'error',
					'code' => 'RS404',
        		    'message' => CustomHandlers::getreSlimMessage('RS404')
				];
			}
				        
			return json_encode($data, JSON_PRETTY_PRINT);
	        $this->db= null;
        }

		/** 
		 * Search all data release book for superuser and admin paginated
		 * @return result process in json encoded data
		 */
		public function searchAllReleaseBook(){
           if (Auth::validToken($this->db,$this->token)){
			   if (Auth::getRoleID($this->db,$this->token) != '3'){
				   $search = "%$this->search%";
					//count total row
					$sqlcountrow = "SELECT count(a.BookID) as TotalRow
						from book_release a 
						inner join core_status b on a.StatusID=b.StatusID
						inner join book_author c on a.AuthorID=c.AuthorID
						inner join book_language d on a.LanguageID=d.LanguageID
						inner join book_translator e on a.TranslatorID=e.TranslatorID
						inner join book_type f on a.TypeID=f.TypeID
						inner join book_publisher g on a.PublisherID=g.PublisherID
						where c.Name like :search
						or d.Name like :search
						or e.Name like :search
						or f.Name like :search
						or g.Name like :search
						or a.ISBN like :search
						or a.Original_released like :search
						or a.Title like :search
						or a.Tags like :search 
						order by a.Created_at desc;";
					$stmt = $this->db->prepare($sqlcountrow);
					$stmt->bindValue(':search', $search, PDO::PARAM_STR);

					if ($stmt->execute()) {	
    		   			if ($stmt->rowCount() > 0){
							$single = $stmt->fetch();
							
							// Paginate won't work if page and items per page is negative.
							// So make sure that page and items per page is always return minimum zero number.
							$newpage = Validation::integerOnly($this->page);
							$newitemsperpage = Validation::integerOnly($this->itemsPerPage);
							$limits = (((($newpage-1)*$newitemsperpage) <= 0)?0:(($newpage-1)*$newitemsperpage));
							$offsets = (($newitemsperpage <= 0)?0:$newitemsperpage);
							
							// Query Data
							$sql = "SELECT a.BookID,a.Image_link as 'Image', a.Title,a.Description,a.AuthorID,c.Name as 'Author',a.`LanguageID`,d.Name as 'Language',a.TranslatorID,e.Name as 'Translator',
									e.Website as 'Translator_web',a.`TypeID`,f.Name as 'Type',a.PublisherID,g.Name as 'Publisher',a.ISBN,a.Original_released,a.Tags,a.Pages,a.Sample_link,a.Full_link,a.Price,a.StatusID,b.`Status`,
									a.Created_at,a.Username,a.Updated_at,a.Updated_by
								from book_release a 
								inner join core_status b on a.StatusID=b.StatusID
								inner join book_author c on a.AuthorID=c.AuthorID
								inner join book_language d on a.LanguageID=d.LanguageID
								inner join book_translator e on a.TranslatorID=e.TranslatorID
								inner join book_type f on a.TypeID=f.TypeID
								inner join book_publisher g on a.PublisherID=g.PublisherID
								where c.Name like :search
								or d.Name like :search
								or e.Name like :search
								or f.Name like :search
								or g.Name like :search
								or a.ISBN like :search
								or a.Original_released like :search
								or a.Title like :search
								or a.Tags like :search
								order by a.Created_at desc LIMIT :limpage , :offpage;";
							$stmt2 = $this->db->prepare($sql);
							$stmt2->bindValue(':search', $search, PDO::PARAM_STR);
							$stmt2->bindValue(':limpage', (INT) $limits, PDO::PARAM_INT);
							$stmt2->bindValue(':offpage', (INT) $offsets, PDO::PARAM_INT);
						
							if ($stmt2->execute()){
								if ($stmt2->rowCount() > 0){
									$datares = "[";
									while($redata = $stmt2->fetch()) 
									{
										$return_arr = null;
										$names = $redata['Tags'];	
										$named = preg_split( "/[;,@#]/", $names );
										foreach($named as $name){
											if ($name != null){$return_arr[] = trim($name);}
										}
										$full = explode("/", $redata['Full_link']);
										$sample = explode("/", $redata['Sample_link']);
									$datares .= '{"BookID":"'.$redata['BookID'].'",
										"Title":'.json_encode($redata['Title']).',
										"Description":'.json_encode($redata['Description']).',
										"Image":'.json_encode($redata['Image']).',
										"AuthorID":'.json_encode($redata['AuthorID']).',
										"Author":'.json_encode($redata['Author']).',
										"LanguageID":'.json_encode($redata['LanguageID']).',
										"Language":'.json_encode($redata['Language']).',
										"TranslatorID":'.json_encode($redata['TranslatorID']).',
										"Translator":'.json_encode($redata['Translator']).',
										"Translator_web":'.json_encode($redata['Translator_web']).',
										"TypeID":'.json_encode($redata['TypeID']).',
										"Type":'.json_encode($redata['Type']).',
										"PublisherID":'.json_encode($redata['PublisherID']).',
										"Publisher":'.json_encode($redata['Publisher']).',
										"ISBN":'.json_encode($redata['ISBN']).',
										"Original_released":'.json_encode($redata['Original_released']).',
										"Tags":'.json_encode($return_arr).',
										"Pages":'.json_encode($redata['Pages']).',
										"Sample_link":'.json_encode($redata['Sample_link']).',
										"Full_link":'.json_encode($redata['Full_link']).',
										"Full_file":'.json_encode(end($full)).',
										"Sample_file":'.json_encode(end($sample)).',
										"Price":'.json_encode($redata['Price']).',
										"StatusID":'.json_encode($redata['StatusID']).',
										"Status":"'.$redata['Status'].'",
										"Created_at":"'.$redata['Created_at'].'",
										"Username":"'.$redata['Username'].'",
										"Updated_at":"'.$redata['Updated_at'].'",
										"Updated_by":"'.$redata['Updated_by'].'"},';
									}
									$datares = substr($datares, 0, -1);
									$datares .= "]";
									$pagination = new \classes\Pagination();
									$pagination->totalRow = $single['TotalRow'];
									$pagination->page = $this->page;
									$pagination->itemsPerPage = $this->itemsPerPage;
									$pagination->fetchAllAssoc = json_decode($datares);
									$data = $pagination->toDataArray();
								} else {
									$data = [
   	    		    					'status' => 'error',
	    	    			    		'code' => 'RS601',
		        				        'message' => CustomHandlers::getreSlimMessage('RS601')
									];
								}
							} else {
								$data = [
       				    			'status' => 'error',
		    			    		'code' => 'RS202',
    			    		    	'message' => CustomHandlers::getreSlimMessage('RS202')
								];	
							}			
					    } else {
   	    					$data = [
       	    					'status' => 'error',
	    	    				'code' => 'RS601',
       			    			'message' => CustomHandlers::getreSlimMessage('RS601')
							];
			    	    }          	   	
					} else {
						$data = [
   	    					'status' => 'error',
							'code' => 'RS202',
        		    		'message' => CustomHandlers::getreSlimMessage('RS202')
						];
					}
				} else {
					$data = [
    	    			'status' => 'error',
	    				'code' => 'RS404',
            	    	'message' => CustomHandlers::getreSlimMessage('RS404')
			    	];
				}
			} else {
				$data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401')
				];
			}		
        
			return json_encode($data, JSON_PRETTY_PRINT);
	        $this->db= null;
        }

		/** 
		 * Get all data Status for Release
		 * @return result process in json encoded data
		 */
		public function showOptionRelease() {
			if (Auth::validToken($this->db,$this->token)){
				$sql = "SELECT a.StatusID,a.Status
					FROM core_status a
					WHERE a.StatusID = '51' OR a.StatusID = '52'
					ORDER BY a.Status ASC";
				
				$stmt = $this->db->prepare($sql);		
				$stmt->bindParam(':token', $this->token, PDO::PARAM_STR);

				if ($stmt->execute()) {	
    	    	    if ($stmt->rowCount() > 0){
        	   		   	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
						$data = [
			   	            'result' => $results, 
    	    		        'status' => 'success', 
			           	    'code' => 'RS501',
        		        	'message' => CustomHandlers::getreSlimMessage('RS501')
						];
			        } else {
        			    $data = [
            		    	'status' => 'error',
		        		    'code' => 'RS601',
        		    	    'message' => CustomHandlers::getreSlimMessage('RS601')
						];
	    	        }          	   	
				} else {
					$data = [
    	    			'status' => 'error',
						'code' => 'RS202',
	        		    'message' => CustomHandlers::getreSlimMessage('RS202')
					];
				}
			} else {
				$data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401')
				];
			}		
        
			return json_encode($data, JSON_PRETTY_PRINT);
	        $this->db= null;
		}

		//Book Library=====================================

		/** 
		 * Get all data Status for Payment
		 * @return result process in json encoded data
		 */
		public function showOptionPayment() {
			if (Auth::validToken($this->db,$this->token)){
				$sql = "SELECT a.StatusID,a.Status
					FROM core_status a
					WHERE a.StatusID = '34' OR a.StatusID = '35'
					ORDER BY a.Status ASC";
				
				$stmt = $this->db->prepare($sql);		
				$stmt->bindParam(':token', $this->token, PDO::PARAM_STR);

				if ($stmt->execute()) {	
    	    	    if ($stmt->rowCount() > 0){
        	   		   	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
						$data = [
			   	            'result' => $results, 
    	    		        'status' => 'success', 
			           	    'code' => 'RS501',
        		        	'message' => CustomHandlers::getreSlimMessage('RS501')
						];
			        } else {
        			    $data = [
            		    	'status' => 'error',
		        		    'code' => 'RS601',
        		    	    'message' => CustomHandlers::getreSlimMessage('RS601')
						];
	    	        }          	   	
				} else {
					$data = [
    	    			'status' => 'error',
						'code' => 'RS202',
	        		    'message' => CustomHandlers::getreSlimMessage('RS202')
					];
				}
			} else {
				$data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401')
				];
			}		
        
			return json_encode($data, JSON_PRETTY_PRINT);
	        $this->db= null;
		}

		/** 
		 * Determine is book free or not
		 * @return boolean true|false
		 */
		public function isBookFree(){
			$newbookid = Validation::integerOnly($this->bookid);
			$r = false;
			$sql = "SELECT a.Price
				FROM book_release a 
				WHERE a.BookID = :bookid and a.StatusID='51';";
			$stmt = $this->db->prepare($sql);
			$stmt->bindParam(':bookid', $newbookid, PDO::PARAM_STR);
			if ($stmt->execute()) {	
            	if ($stmt->rowCount() > 0){
					$single = $stmt->fetch();
					if ((empty($single['Price'])) || $single['Price'] == 0 ){
                        $r = true;
                    }
    	        }          	   	
			} 		
			return $r;
			$this->db = null;
		}

		/** 
		 * Determine is book already exis on library or not
		 * @return boolean true|false
		 */
		public function isBookExistOnLibrary(){
			$newusername = strtolower(filter_var($this->username,FILTER_SANITIZE_STRING));
			$newbookid = Validation::integerOnly($this->bookid);
			$r = false;
			$sql = "SELECT a.BookID,a.Username
				FROM book_library a 
				WHERE a.BookID = :bookid and a.Username=:username;";
			$stmt = $this->db->prepare($sql);
			$stmt->bindParam(':username', $newusername, PDO::PARAM_STR);
			$stmt->bindParam(':bookid', $newbookid, PDO::PARAM_STR);
			if ($stmt->execute()) {	
            	if ($stmt->rowCount() > 0){
					$r = true;
    	        }          	   	
			} 		
			return $r;
			$this->db = null;
		}

		/** 
		 * Add new library book
		 * @return result process in json encoded data
		 */
		public function addLibraryBook(){
			if (Auth::validToken($this->db,$this->token,$this->username)){
				$newusername = strtolower(filter_var($this->username,FILTER_SANITIZE_STRING));
				$newbookid = Validation::integerOnly($this->bookid);
				$newprice = Validation::integerOnly($this->price);
				$newguid = Auth::generateUniqueID(7).$newbookid;
				if (!$this->isBookExistOnLibrary()){
					if ($this->isBookFree()) {
						$newstatus = '34';
					} else {
						$newstatus = '35';
					}
					try {
	    				$this->db->beginTransaction();
			    		$sql = "INSERT INTO book_library (BookID,Username,Guid,Price,StatusID,Created_at) 
							VALUES (:bookid,:username,:guid,:price,:status,current_timestamp);";
						$stmt = $this->db->prepare($sql);
    					$stmt->bindParam(':username', $newusername, PDO::PARAM_STR);
	                    $stmt->bindParam(':bookid', $newbookid, PDO::PARAM_STR);
						$stmt->bindParam(':status', $newstatus, PDO::PARAM_STR);
						$stmt->bindParam(':guid', $newguid, PDO::PARAM_STR);
						$stmt->bindParam(':price', $newprice, PDO::PARAM_STR);
						if ($stmt->execute()) {
				    		$data = [
					    		'status' => 'success',
					    		'code' => 'RS101',
						    	'message' => CustomHandlers::getreSlimMessage('RS101')
    						];	
						} else {
			    			$data = [
								'status' => 'error',
				    			'code' => 'RS201',
					    		'message' => CustomHandlers::getreSlimMessage('RS201')
							];
		    			}
			    	    $this->db->commit();
				    } catch (PDOException $e) {
				        $data = [
    				    	'status' => 'error',
    	    				'code' => $e->getCode(),
	    	    			'message' => $e->getMessage()
			    		];
		    			$this->db->rollBack();
        			}
				} else {
					$data = [
		    			'status' => 'error',
						'code' => 'RS603',
        		    	'message' => CustomHandlers::getreSlimMessage('RS603')
					];
				}   
            } else {
                $data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401')
				];
            }

			return json_encode($data, JSON_PRETTY_PRINT);
			$this->db = null;
		}

		/** 
		 * Update data library book
		 * @return result process in json encoded data
		 */
		public function updateLibraryBook(){
            if (Auth::validToken($this->db,$this->token,$this->adminname)){
				if (Auth::getRoleID($this->db,$this->token) != '3'){
					$newusername = strtolower(filter_var($this->username,FILTER_SANITIZE_STRING));
					$newadminname = strtolower(filter_var($this->adminname,FILTER_SANITIZE_STRING));
    	            $newbookid = Validation::integerOnly($this->bookid);
					$newstatusid = Validation::integerOnly($this->statusid);
	    		    try {
    					$this->db->beginTransaction();
		    			$sql = "UPDATE book_library a SET a.StatusID=:status,a.Updated_by=:admin
							WHERE a.BookID=:bookid and a.Username=:username;";
						$stmt = $this->db->prepare($sql);
    					$stmt->bindParam(':username', $newusername, PDO::PARAM_STR);
						$stmt->bindParam(':admin', $newadminname, PDO::PARAM_STR);
            	        $stmt->bindParam(':bookid', $newbookid, PDO::PARAM_STR);
						$stmt->bindParam(':status', $newstatusid, PDO::PARAM_STR);
						if ($stmt->execute()) {
				    		$data = [
					    		'status' => 'success',
					    		'code' => 'RS103',
						    	'message' => CustomHandlers::getreSlimMessage('RS103')
    						];	
						} else {
		    				$data = [
								'status' => 'error',
				    			'code' => 'RS203',
					    		'message' => CustomHandlers::getreSlimMessage('RS203')
							];
	    				}
		    		    $this->db->commit();
				    } catch (PDOException $e) {
				        $data = [
    				    	'status' => 'error',
    	    				'code' => $e->getCode(),
	    	    			'message' => $e->getMessage()
		    			];
		    			$this->db->rollBack();
    	    		}
				} else {
					$data = [
						'status' => 'error',
			    		'code' => 'RS404',
						'message' => CustomHandlers::getreSlimMessage('RS404')
					];
				}
            } else {
                $data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401')
				];
            }

			return json_encode($data, JSON_PRETTY_PRINT);
			$this->db = null;
        }

		/** 
		 * Delete library book
		 * @return result process in json encoded data
		 */
        public function deleteLibraryBook(){
            if (Auth::validToken($this->db,$this->token)){
				$newbookid = Validation::integerOnly($this->bookid);
				$newusername = strtolower(filter_var($this->username,FILTER_SANITIZE_STRING));
        		try {
	        		$this->db->beginTransaction();
		        	$sql = "DELETE FROM book_library 
			    		WHERE BookID=:bookid and Username=:username;";
			    	$stmt = $this->db->prepare($sql);
                    $stmt->bindParam(':bookid', $newbookid, PDO::PARAM_STR);
					$stmt->bindParam(':username', $newusername, PDO::PARAM_STR);
					if ($stmt->execute()) {
	    				$data = [
		    				'status' => 'success',
			    			'code' => 'RS104',
			    			'message' => CustomHandlers::getreSlimMessage('RS104')
				    	];	
    				} else {
	    				$data = [
		    				'status' => 'error',
			    			'code' => 'RS204',
			    			'message' => CustomHandlers::getreSlimMessage('RS204')
				    	];
    				}
    			    $this->db->commit();
    	    	} catch (PDOException $e) {
	    			$data = [
			    		'status' => 'error',
		    	    	'code' => $e->getCode(),
			    	    'message' => $e->getMessage()
        			];
	        		$this->db->rollBack();
    	    	}
            } else {
                $data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401')
				];
            }
            
			return json_encode($data, JSON_PRETTY_PRINT);
			$this->db = null;
        }

		/** 
		 * Show all data pending library book paginated for superuser and admin
		 * @return result process in json encoded data
		 */
		public function showPendingLibraryBook(){
           if (Auth::validToken($this->db,$this->token)){
				if (Auth::getRoleID($this->db,$this->token) != '3'){
					$search = "%$this->search%";
					$sqlcountrow = "SELECT count(a.BookID) as TotalRow
					FROM book_library a
					INNER JOIN book_release b ON a.BookID = b.BookID
					INNER JOIN core_status c ON a.StatusID = c.StatusID
					INNER JOIN book_language d ON b.LanguageID = d.LanguageID
					INNER JOIN book_author e ON b.AuthorID = e.AuthorID
					INNER JOIN book_translator f ON b.TranslatorID = f.TranslatorID
					INNER JOIN book_type g ON b.TypeID = g.TypeID
					INNER JOIN book_publisher h ON b.PublisherID = h.PublisherID
					WHERE a.StatusID = '35' and b.Title like :search
					OR a.StatusID = '35' and a.BookID like :search
					OR a.StatusID = '35' and a.Guid like :search
					OR a.StatusID = '35' and a.Username like :search
					OR a.StatusID = '35' and d.Name like :search
					OR a.StatusID = '35' and e.Name like :search
					OR a.StatusID = '35' and f.Name like :search
					OR a.StatusID = '35' and g.Name like :search
					OR a.StatusID = '35' and h.Name like :search
					ORDER BY a.Created_at ASC;";
					$stmt = $this->db->prepare($sqlcountrow);
					$stmt->bindParam(':search', $search, PDO::PARAM_STR);

					if ($stmt->execute()) {	
    	    	    	if ($stmt->rowCount() > 0){
							$single = $stmt->fetch();
						
							// Paginate won't work if page and items per page is negative.
							// So make sure that page and items per page is always return minimum zero number.
							$newpage = Validation::integerOnly($this->page);
							$newitemsperpage = Validation::integerOnly($this->itemsPerPage);
							$limits = (((($newpage-1)*$newitemsperpage) <= 0)?0:(($newpage-1)*$newitemsperpage));
							$offsets = (($newitemsperpage <= 0)?0:$newitemsperpage);

							// Query Data
							$sql = "SELECT a.Created_at,a.Guid,a.BookID,b.Image_link,b.Title,a.Username,a.Price,a.StatusID,c.Status
								FROM book_library a
								INNER JOIN book_release b ON a.BookID = b.BookID
								INNER JOIN core_status c ON a.StatusID = c.StatusID
								INNER JOIN book_language d ON b.LanguageID = d.LanguageID
								INNER JOIN book_author e ON b.AuthorID = e.AuthorID
								INNER JOIN book_translator f ON b.TranslatorID = f.TranslatorID
								INNER JOIN book_type g ON b.TypeID = g.TypeID
								INNER JOIN book_publisher h ON b.PublisherID = h.PublisherID
								WHERE a.StatusID = '35' and b.Title like :search
								OR a.StatusID = '35' and a.BookID like :search
								OR a.StatusID = '35' and a.Guid like :search
								OR a.StatusID = '35' and a.Username like :search
								OR a.StatusID = '35' and d.Name like :search
								OR a.StatusID = '35' and e.Name like :search
								OR a.StatusID = '35' and f.Name like :search
								OR a.StatusID = '35' and g.Name like :search
								OR a.StatusID = '35' and h.Name like :search
								ORDER BY a.Created_at ASC LIMIT :limpage , :offpage;";
							$stmt2 = $this->db->prepare($sql);
							$stmt2->bindParam(':search', $search, PDO::PARAM_STR);
							$stmt2->bindValue(':limpage', (INT) $limits, PDO::PARAM_INT);
							$stmt2->bindValue(':offpage', (INT) $offsets, PDO::PARAM_INT);
						
							if ($stmt2->execute()){
								$pagination = new \classes\Pagination();
								$pagination->totalRow = $single['TotalRow'];
								$pagination->page = $this->page;
								$pagination->itemsPerPage = $this->itemsPerPage;
								$pagination->fetchAllAssoc = $stmt2->fetchAll(PDO::FETCH_ASSOC);
								$data = $pagination->toDataArray();
							} else {
								$data = [
        	    		    		'status' => 'error',
		    	    		    	'code' => 'RS202',
	        			    	    'message' => CustomHandlers::getreSlimMessage('RS202')
								];	
							}			
				        } else {
    	    			    $data = [
        	    		    	'status' => 'error',
		    	    		    'code' => 'RS601',
        			    	    'message' => CustomHandlers::getreSlimMessage('RS601')
							];
		    	        }          	   	
					} else {
						$data = [
    	    				'status' => 'error',
							'code' => 'RS202',
	        			    'message' => CustomHandlers::getreSlimMessage('RS202')
						];
					}
				} else {
					$data = [
		    			'status' => 'error',
						'code' => 'RS404',
        		    	'message' => CustomHandlers::getreSlimMessage('RS404')
					];
				}
			} else {
				$data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401')
				];
			}		
        
			return json_encode($data, JSON_PRETTY_PRINT);
	        $this->db= null;
        }

		/** 
		 * Show all data premium library book paginated for all user
		 * @return result process in json encoded data
		 */
		public function showPremiumLibraryBookUser(){
           if (Auth::validToken($this->db,$this->token)){
			    $newusername = strtolower(filter_var($this->username,FILTER_SANITIZE_STRING));
				$search = "%$this->search%";
				$sqlcountrow = "SELECT count(a.BookID) as TotalRow
					FROM book_library a
					INNER JOIN book_release b ON a.BookID = b.BookID
					INNER JOIN core_status c ON a.StatusID = c.StatusID
					INNER JOIN book_language d ON b.LanguageID = d.LanguageID
					INNER JOIN book_author e ON b.AuthorID = e.AuthorID
					INNER JOIN book_translator f ON b.TranslatorID = f.TranslatorID
					INNER JOIN book_type g ON b.TypeID = g.TypeID
					INNER JOIN book_publisher h ON b.PublisherID = h.PublisherID
					WHERE a.Username = :username and a.Price <> '0' and b.Title like :search
					OR a.Username = :username and a.Price <> '0' and a.BookID like :search
					OR a.Username = :username and a.Price <> '0' and a.Guid like :search
					OR a.Username = :username and a.Price <> '0' and d.Name like :search
					OR a.Username = :username and a.Price <> '0' and e.Name like :search
					OR a.Username = :username and a.Price <> '0' and f.Name like :search
					OR a.Username = :username and a.Price <> '0' and g.Name like :search
					OR a.Username = :username and a.Price <> '0' and h.Name like :search
					ORDER BY a.StatusID DESC,a.Created_at DESC;";
				$stmt = $this->db->prepare($sqlcountrow);
				$stmt->bindParam(':search', $search, PDO::PARAM_STR);
				$stmt->bindParam(':username', $newusername, PDO::PARAM_STR);

				if ($stmt->execute()) {	
    	    	    if ($stmt->rowCount() > 0){
						$single = $stmt->fetch();
						
						// Paginate won't work if page and items per page is negative.
						// So make sure that page and items per page is always return minimum zero number.
						$newpage = Validation::integerOnly($this->page);
						$newitemsperpage = Validation::integerOnly($this->itemsPerPage);
						$limits = (((($newpage-1)*$newitemsperpage) <= 0)?0:(($newpage-1)*$newitemsperpage));
						$offsets = (($newitemsperpage <= 0)?0:$newitemsperpage);

						// Query Data
						$sql = "SELECT a.Created_at,a.Guid,a.BookID,b.Image_link,b.Title,a.Username,a.Price,a.StatusID,c.Status
							FROM book_library a
							INNER JOIN book_release b ON a.BookID = b.BookID
							INNER JOIN core_status c ON a.StatusID = c.StatusID
							INNER JOIN book_language d ON b.LanguageID = d.LanguageID
							INNER JOIN book_author e ON b.AuthorID = e.AuthorID
							INNER JOIN book_translator f ON b.TranslatorID = f.TranslatorID
							INNER JOIN book_type g ON b.TypeID = g.TypeID
							INNER JOIN book_publisher h ON b.PublisherID = h.PublisherID
							WHERE a.Username = :username and a.Price <> '0' and b.Title like :search
							OR a.Username = :username and a.Price <> '0' and a.BookID like :search
							OR a.Username = :username and a.Price <> '0' and a.Guid like :search
							OR a.Username = :username and a.Price <> '0' and d.Name like :search
							OR a.Username = :username and a.Price <> '0' and e.Name like :search
							OR a.Username = :username and a.Price <> '0' and f.Name like :search
							OR a.Username = :username and a.Price <> '0' and g.Name like :search
							OR a.Username = :username and a.Price <> '0' and h.Name like :search
							ORDER BY a.StatusID DESC,a.Created_at DESC LIMIT :limpage , :offpage;";
						$stmt2 = $this->db->prepare($sql);
						$stmt2->bindParam(':search', $search, PDO::PARAM_STR);
						$stmt2->bindParam(':username', $newusername, PDO::PARAM_STR);
						$stmt2->bindValue(':limpage', (INT) $limits, PDO::PARAM_INT);
						$stmt2->bindValue(':offpage', (INT) $offsets, PDO::PARAM_INT);
						
						if ($stmt2->execute()){
							$pagination = new \classes\Pagination();
							$pagination->totalRow = $single['TotalRow'];
							$pagination->page = $this->page;
							$pagination->itemsPerPage = $this->itemsPerPage;
							$pagination->fetchAllAssoc = $stmt2->fetchAll(PDO::FETCH_ASSOC);
							$data = $pagination->toDataArray();
						} else {
							$data = [
        	    	    		'status' => 'error',
		        		    	'code' => 'RS202',
	    			    	    'message' => CustomHandlers::getreSlimMessage('RS202')
							];	
						}			
				    } else {
    	    			$data = [
        	    	    	'status' => 'error',
		    			    'code' => 'RS601',
        		    	    'message' => CustomHandlers::getreSlimMessage('RS601')
						];
	    	        }          	   	
				} else {
					$data = [
    					'status' => 'error',
						'code' => 'RS202',
        			    'message' => CustomHandlers::getreSlimMessage('RS202')
					];
				}
			} else {
				$data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401')
				];
			}		
        
			return json_encode($data, JSON_PRETTY_PRINT);
	        $this->db= null;
        }

		/** 
		 * Show all data library book paginated for member only
		 * @return result process in json encoded data
		 */
		public function showAllLibraryBook(){
           if (Auth::validToken($this->db,$this->token)){
				$newusername = strtolower(filter_var($this->username,FILTER_SANITIZE_STRING));
				$search = "%$this->search%";
				$sqlcountrow = "SELECT count(a.BookID) as TotalRow
					FROM book_library a
					INNER JOIN book_release b ON a.BookID = b.BookID
					INNER JOIN core_status c ON a.StatusID = c.StatusID
					INNER JOIN book_language d ON b.LanguageID = d.LanguageID
					INNER JOIN book_author e ON b.AuthorID = e.AuthorID
					INNER JOIN book_translator f ON b.TranslatorID = f.TranslatorID
					INNER JOIN book_type g ON b.TypeID = g.TypeID
					INNER JOIN book_publisher h ON b.PublisherID = h.PublisherID
					WHERE a.Username=:username and b.Title like :search
					OR a.Username=:username and a.BookID like :search
					OR a.Username=:username and a.Guid like :search
					OR a.Username=:username and b.Tags like :search
					OR a.Username=:username and d.Name like :search
					OR a.Username=:username and e.Name like :search
					OR a.Username=:username and f.Name like :search
					OR a.Username=:username and g.Name like :search
					OR a.Username=:username and h.Name like :search
					ORDER BY a.Created_at DESC;";
				$stmt = $this->db->prepare($sqlcountrow);
				$stmt->bindParam(':search', $search, PDO::PARAM_STR);
				$stmt->bindParam(':username', $newusername, PDO::PARAM_STR);

				if ($stmt->execute()) {	
    	        	if ($stmt->rowCount() > 0){
						$single = $stmt->fetch();
						
						// Paginate won't work if page and items per page is negative.
						// So make sure that page and items per page is always return minimum zero number.
						$newpage = Validation::integerOnly($this->page);
						$newitemsperpage = Validation::integerOnly($this->itemsPerPage);
						$limits = (((($newpage-1)*$newitemsperpage) <= 0)?0:(($newpage-1)*$newitemsperpage));
						$offsets = (($newitemsperpage <= 0)?0:$newitemsperpage);

						// Query Data
						$sql = "SELECT a.Created_at,a.Guid,a.BookID,b.Image_link,b.Title,b.Description,b.Pages,d.Name as 'Language',e.Name as 'Author',f.Name as 'Translator',g.Name as 'Type',h.Name as 'Publisher',b.ISBN,b.Original_released,b.Tags,a.Price,a.Username,a.StatusID,c.Status,
							b.Sample_link,if(a.StatusID='34',b.Full_link,'You have to make payment first!') as Full_link,a.Updated_at,a.Updated_by
							FROM book_library a
							INNER JOIN book_release b ON a.BookID = b.BookID
							INNER JOIN core_status c ON a.StatusID = c.StatusID
							INNER JOIN book_language d ON b.LanguageID = d.LanguageID
							INNER JOIN book_author e ON b.AuthorID = e.AuthorID
							INNER JOIN book_translator f ON b.TranslatorID = f.TranslatorID
							INNER JOIN book_type g ON b.TypeID = g.TypeID
							INNER JOIN book_publisher h ON b.PublisherID = h.PublisherID
							WHERE a.Username=:username and b.Title like :search
							OR a.Username=:username and a.BookID like :search
							OR a.Username=:username and a.Guid like :search
							OR a.Username=:username and b.Tags like :search
							OR a.Username=:username and d.Name like :search
							OR a.Username=:username and e.Name like :search
							OR a.Username=:username and f.Name like :search
							OR a.Username=:username and g.Name like :search
							OR a.Username=:username and h.Name like :search
							ORDER BY a.Created_at DESC LIMIT :limpage , :offpage;";
						$stmt2 = $this->db->prepare($sql);
						$stmt2->bindParam(':username', $newusername, PDO::PARAM_STR);
						$stmt2->bindParam(':search', $search, PDO::PARAM_STR);
						$stmt2->bindValue(':limpage', (INT) $limits, PDO::PARAM_INT);
						$stmt2->bindValue(':offpage', (INT) $offsets, PDO::PARAM_INT);
						
						if ($stmt2->execute()){
							if ($stmt2->rowCount() > 0){
								$datares = "[";
									while($redata = $stmt2->fetch()) 
									{
										$return_arr = null;
										$names = $redata['Tags'];	
										$named = preg_split( "/[;,@#]/", $names );
										foreach($named as $name){
											if ($name != null){$return_arr[] = trim($name);}
										}
										$full = explode("/", $redata['Full_link']);
										$sample = explode("/", $redata['Sample_link']);
									$datares .= '{"BookID":"'.$redata['BookID'].'",
										"Title":'.json_encode($redata['Title']).',
										"Description":'.json_encode($redata['Description']).',
										"Image_link":'.json_encode($redata['Image_link']).',
										"Language":'.json_encode($redata['Language']).',
										"Author":'.json_encode($redata['Author']).',
										"Translator":'.json_encode($redata['Translator']).',
										"Type":'.json_encode($redata['Type']).',
										"Publisher":'.json_encode($redata['Publisher']).',
										"ISBN":'.json_encode($redata['ISBN']).',
										"Original_released":'.json_encode($redata['Original_released']).',
										"Guid":'.json_encode($redata['Guid']).',
										"Tags":'.json_encode($return_arr).',
										"Pages":'.json_encode($redata['Pages']).',
										"Sample_link":'.json_encode($redata['Sample_link']).',
										"Full_link":'.json_encode($redata['Full_link']).',
										"Full_file":'.json_encode(end($full)).',
										"Sample_file":'.json_encode(end($sample)).',
										"Price":'.json_encode($redata['Price']).',
										"StatusID":'.json_encode($redata['StatusID']).',
										"Status":"'.$redata['Status'].'",
										"Created_at":"'.$redata['Created_at'].'",
										"Username":"'.$redata['Username'].'",
										"Updated_at":"'.$redata['Updated_at'].'",
										"Updated_by":"'.$redata['Updated_by'].'"},';
									}
									$datares = substr($datares, 0, -1);
									$datares .= "]";
									$pagination = new \classes\Pagination();
									$pagination->totalRow = $single['TotalRow'];
									$pagination->page = $this->page;
									$pagination->itemsPerPage = $this->itemsPerPage;
									$pagination->fetchAllAssoc = json_decode($datares);
									$data = $pagination->toDataArray();
							} else {
								$data = [
   	    		    				'status' => 'error',
	    	    			    	'code' => 'RS601',
		        				    'message' => CustomHandlers::getreSlimMessage('RS601')
								];
							}
						} else {
							$data = [
        	    				'status' => 'error',
		    	    	    	'code' => 'RS202',
	        		    	    'message' => CustomHandlers::getreSlimMessage('RS202')
							];	
						}			
			        } else {
	    			    $data = [
        	    		    'status' => 'error',
		    	    	    'code' => 'RS601',
        				    'message' => CustomHandlers::getreSlimMessage('RS601')
						];
		            }          	   	
				} else {
					$data = [
    	    			'status' => 'error',
						'code' => 'RS202',
	    			    'message' => CustomHandlers::getreSlimMessage('RS202')
					];
				}
			} else {
				$data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401')
				];
			}		
        
			return json_encode($data, JSON_PRETTY_PRINT);
	        $this->db= null;
        }

		/** 
		 * Show single data library book paginated for member only
		 * @return result process in json encoded data
		 */
		public function showSingleLibraryBook(){
           if (Auth::validToken($this->db,$this->token)){
			   $newbookid = Validation::integerOnly($this->bookid);
				$newusername = strtolower(filter_var($this->username,FILTER_SANITIZE_STRING));
				$sqlcountrow = "SELECT count(a.BookID) as TotalRow
					FROM book_library a
					INNER JOIN book_release b ON a.BookID = b.BookID
					INNER JOIN core_status c ON a.StatusID = c.StatusID
					INNER JOIN book_language d ON b.LanguageID = d.LanguageID
					INNER JOIN book_author e ON b.AuthorID = e.AuthorID
					INNER JOIN book_translator f ON b.TranslatorID = f.TranslatorID
					INNER JOIN book_type g ON b.TypeID = g.TypeID
					INNER JOIN book_publisher h ON b.PublisherID = h.PublisherID
					WHERE a.Username=:username and a.BookID = :bookid
					ORDER BY a.Created_at ASC;";
				$stmt = $this->db->prepare($sqlcountrow);
				$stmt->bindParam(':bookid', $newbookid, PDO::PARAM_STR);
				$stmt->bindParam(':username', $newusername, PDO::PARAM_STR);

				if ($stmt->execute()) {	
    	        	if ($stmt->rowCount() > 0){
						$single = $stmt->fetch();
						
						// Query Data
						$sql = "SELECT a.Created_at,a.Guid,a.BookID,b.Image_link,b.Title,b.Description,b.Pages,d.Name as 'Language',e.Name as 'Author',f.Name as 'Translator',g.Name as 'Type',h.Name as 'Publisher',b.ISBN,b.Original_released,b.Tags,a.Price,a.Username,a.StatusID,c.Status,
							b.Sample_link,if(a.StatusID='34',b.Full_link,'You have to make payment first!') as Full_link,a.Updated_at,a.Updated_by
							FROM book_library a
							INNER JOIN book_release b ON a.BookID = b.BookID
							INNER JOIN core_status c ON a.StatusID = c.StatusID
							INNER JOIN book_language d ON b.LanguageID = d.LanguageID
							INNER JOIN book_author e ON b.AuthorID = e.AuthorID
							INNER JOIN book_translator f ON b.TranslatorID = f.TranslatorID
							INNER JOIN book_type g ON b.TypeID = g.TypeID
							INNER JOIN book_publisher h ON b.PublisherID = h.PublisherID
							WHERE a.Username=:username and a.BookID = :bookid
							ORDER BY a.Created_at ASC;";
						$stmt2 = $this->db->prepare($sql);
						$stmt2->bindParam(':username', $newusername, PDO::PARAM_STR);
						$stmt2->bindParam(':bookid', $newbookid, PDO::PARAM_STR);
						
						if ($stmt2->execute()){
							if ($stmt2->rowCount() > 0){
								$datares = "[";
									while($redata = $stmt2->fetch()) 
									{
										$return_arr = null;
										$names = $redata['Tags'];	
										$named = preg_split( "/[;,@#]/", $names );
										foreach($named as $name){
											if ($name != null){$return_arr[] = trim($name);}
										}
										$full = explode("/", $redata['Full_link']);
										$sample = explode("/", $redata['Sample_link']);
									$datares .= '{"BookID":"'.$redata['BookID'].'",
										"Title":'.json_encode($redata['Title']).',
										"Description":'.json_encode($redata['Description']).',
										"Image_link":'.json_encode($redata['Image_link']).',
										"Language":'.json_encode($redata['Language']).',
										"Author":'.json_encode($redata['Author']).',
										"Translator":'.json_encode($redata['Translator']).',
										"Type":'.json_encode($redata['Type']).',
										"Publisher":'.json_encode($redata['Publisher']).',
										"ISBN":'.json_encode($redata['ISBN']).',
										"Original_released":'.json_encode($redata['Original_released']).',
										"Guid":'.json_encode($redata['Guid']).',
										"Tags_inline":'.json_encode($redata['Tags']).',
										"Tags":'.json_encode($return_arr).',
										"Pages":'.json_encode($redata['Pages']).',
										"Sample_link":'.json_encode($redata['Sample_link']).',
										"Full_link":'.json_encode($redata['Full_link']).',
										"Full_file":'.json_encode(end($full)).',
										"Sample_file":'.json_encode(end($sample)).',
										"Price":'.json_encode($redata['Price']).',
										"StatusID":'.json_encode($redata['StatusID']).',
										"Status":"'.$redata['Status'].'",
										"Created_at":"'.$redata['Created_at'].'",
										"Username":"'.$redata['Username'].'",
										"Updated_at":"'.$redata['Updated_at'].'",
										"Updated_by":"'.$redata['Updated_by'].'"},';
									}
									$datares = substr($datares, 0, -1);
									$datares .= "]";
									$data = ['result' => json_decode($datares),
                                'status' => 'success',
                                'code' => 'RS501',
			    				'message' =>  CustomHandlers::getreSlimMessage('RS501')];
							} else {
								$data = [
   	    		    				'status' => 'error',
	    	    			    	'code' => 'RS601',
		        				    'message' => CustomHandlers::getreSlimMessage('RS601')
								];
							}
						} else {
							$data = [
        	    				'status' => 'error',
		    	    	    	'code' => 'RS202',
	        		    	    'message' => CustomHandlers::getreSlimMessage('RS202')
							];	
						}			
			        } else {
	    			    $data = [
        	    		    'status' => 'error',
		    	    	    'code' => 'RS601',
        				    'message' => CustomHandlers::getreSlimMessage('RS601')
						];
		            }          	   	
				} else {
					$data = [
    	    			'status' => 'error',
						'code' => 'RS202',
	    			    'message' => CustomHandlers::getreSlimMessage('RS202')
					];
				}
			} else {
				$data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401')
				];
			}		
        
			return json_encode($data, JSON_PRETTY_PRINT);
	        $this->db= null;
        }

		//Sales Report=====================================

		/** 
		 * Show all data report sales premium book paginated
		 * @return result process in json encoded data
		 */
		public function showAllReportSales(){
			if (Auth::validToken($this->db,$this->token)){
				$newusername = strtolower(filter_var($this->username,FILTER_SANITIZE_STRING));
				$newfirstdate = filter_var($this->firstdate,FILTER_SANITIZE_STRING);
				$newlastdate = filter_var($this->lastdate,FILTER_SANITIZE_STRING);
				$search = "%$this->search%";
				if (Auth::getRoleID($this->db,$this->token) != '3'){
					$sqlcountrow = "SELECT count(*) as TotalRow from (	
							SELECT concat(:firstdate,' - ',:lastdate) as DateRange,a.BookID,a.Title,a.Pages,a.Price, count(a.BookID)*b.Price as `Total_Income`,count(a.BookID) as Total_Sales,
								if (c.SubmitBookID is not null,ifnull(round((count(a.BookID)*b.Price)*(70/100)),0),'0') as Total_Royalti_User,
								if (c.SubmitBookID is not null,ifnull(round((count(a.BookID)*b.Price)*(30/100)),0),'0') as Total_Royalti_Company,
								c.username as Royalti_Username
							from book_release a
							inner join book_library b on a.BookID = b.BookID
							left join book_submit c on a.BookID = c.BookID
							where date(b.Created_at) between :firstdate and :lastdate
							and a.Price <> 0 and b.StatusID='34' and c.Username like :search
							or date(b.Created_at) between :firstdate and :lastdate
							and a.Price <> 0 and b.StatusID='34' and a.Title like :search
							or date(b.Created_at) between :firstdate and :lastdate
							and a.Price <> 0 and b.StatusID='34' and a.BookID like :search
							group by a.BookID
							order by a.Created_at desc) x;";
					$stmt = $this->db->prepare($sqlcountrow);
					$stmt->bindParam(':search', $search, PDO::PARAM_STR);
					$stmt->bindParam(':firstdate', $newfirstdate, PDO::PARAM_STR);
					$stmt->bindParam(':lastdate', $newlastdate, PDO::PARAM_STR);
				} else {
					$sqlcountrow = "SELECT count(*) as TotalRow from (	
							SELECT concat(:firstdate,' - ',:lastdate) as DateRange,a.BookID,a.Title,a.Pages,a.Price, count(a.BookID)*b.Price as `Total_Income`,count(a.BookID) as Total_Sales,
								if (c.SubmitBookID is not null,ifnull(round((count(a.BookID)*b.Price)*(70/100)),0),'0') as Total_Royalti_User,
								if (c.SubmitBookID is not null,ifnull(round((count(a.BookID)*b.Price)*(30/100)),0),'0') as Total_Royalti_Company,
								c.username as Royalti_Username
							from book_release a
							inner join book_library b on a.BookID = b.BookID
							left join book_submit c on a.BookID = c.BookID
							where date(b.Created_at) between :firstdate and :lastdate
							and a.Price <> 0 and b.StatusID='34' and c.Username = :username
							or date(b.Created_at) between :firstdate and :lastdate
							and a.Price <> 0 and b.StatusID='34' and c.Username = :username and a.Title like :search
							or date(b.Created_at) between :firstdate and :lastdate
							and a.Price <> 0 and b.StatusID='34' and c.Username = :username and a.BookID like :search
							group by a.BookID
							order by a.Created_at desc) x;";
					$stmt = $this->db->prepare($sqlcountrow);
					$stmt->bindParam(':search', $search, PDO::PARAM_STR);
					$stmt->bindParam(':username', $newusername, PDO::PARAM_STR);
					$stmt->bindParam(':firstdate', $newfirstdate, PDO::PARAM_STR);
					$stmt->bindParam(':lastdate', $newlastdate, PDO::PARAM_STR);
				}
				

				if ($stmt->execute()) {	
    	        	if ($stmt->rowCount() > 0){
						$single = $stmt->fetch();
						
						// Paginate won't work if page and items per page is negative.
						// So make sure that page and items per page is always return minimum zero number.
						$newpage = Validation::integerOnly($this->page);
						$newitemsperpage = Validation::integerOnly($this->itemsPerPage);
						$limits = (((($newpage-1)*$newitemsperpage) <= 0)?0:(($newpage-1)*$newitemsperpage));
						$offsets = (($newitemsperpage <= 0)?0:$newitemsperpage);

						if (Auth::getRoleID($this->db,$this->token) != '3'){
							// Query Data
							$sql = "SELECT * from (	
								SELECT concat(:firstdate,' - ',:lastdate) as DateRange,a.BookID,a.Title,a.Pages,a.Price, count(a.BookID)*b.Price as `Total_Income`,count(a.BookID) as Total_Sales,
									if (c.SubmitBookID is not null,ifnull(round((count(a.BookID)*b.Price)*(70/100)),0),'0') as Total_Royalti_User,
									if (c.SubmitBookID is not null,ifnull(round((count(a.BookID)*b.Price)*(30/100)),0),'0') as Total_Royalti_Company,
									c.username as Royalti_Username
								from book_release a
								inner join book_library b on a.BookID = b.BookID
								left join book_submit c on a.BookID = c.BookID
								where date(b.Created_at) between :firstdate and :lastdate
								and a.Price <> 0 and b.StatusID='34' and c.Username like :search
								or date(b.Created_at) between :firstdate and :lastdate
								and a.Price <> 0 and b.StatusID='34' and a.Title like :search
								or date(b.Created_at) between :firstdate and :lastdate
								and a.Price <> 0 and b.StatusID='34' and a.BookID like :search
								group by a.BookID
								order by a.Created_at desc) x;";
							$stmt2 = $this->db->prepare($sql);
							$stmt2->bindParam(':search', $search, PDO::PARAM_STR);
							$stmt2->bindParam(':firstdate', $newfirstdate, PDO::PARAM_STR);
							$stmt2->bindParam(':lastdate', $newlastdate, PDO::PARAM_STR);
							$stmt2->bindValue(':limpage', (INT) $limits, PDO::PARAM_INT);
							$stmt2->bindValue(':offpage', (INT) $offsets, PDO::PARAM_INT);
						} else {
							// Query Data
							$sql = "SELECT * from (	
								SELECT concat(:firstdate,' - ',:lastdate) as DateRange,a.BookID,a.Title,a.Pages,a.Price, count(a.BookID)*b.Price as `Total_Income`,count(a.BookID) as Total_Sales,
									if (c.SubmitBookID is not null,ifnull(round((count(a.BookID)*b.Price)*(70/100)),0),'0') as Total_Royalti_User,
									if (c.SubmitBookID is not null,ifnull(round((count(a.BookID)*b.Price)*(30/100)),0),'0') as Total_Royalti_Company,
									c.username as Royalti_Username
								from book_release a
								inner join book_library b on a.BookID = b.BookID
								left join book_submit c on a.BookID = c.BookID
								where date(b.Created_at) between :firstdate and :lastdate
								and a.Price <> 0 and b.StatusID='34' and c.Username=:username
								or date(b.Created_at) between :firstdate and :lastdate
								and a.Price <> 0 and b.StatusID='34' and c.Username=:username and a.Title like :search
								or date(b.Created_at) between :firstdate and :lastdate
								and a.Price <> 0 and b.StatusID='34' and c.Username=:username and a.BookID like :search
								group by a.BookID
								order by a.Created_at desc) x;";
							$stmt2 = $this->db->prepare($sql);
							$stmt2->bindParam(':search', $search, PDO::PARAM_STR);
							$stmt2->bindParam(':username', $newusername, PDO::PARAM_STR);
							$stmt2->bindParam(':firstdate', $newfirstdate, PDO::PARAM_STR);
							$stmt2->bindParam(':lastdate', $newlastdate, PDO::PARAM_STR);
							$stmt2->bindValue(':limpage', (INT) $limits, PDO::PARAM_INT);
							$stmt2->bindValue(':offpage', (INT) $offsets, PDO::PARAM_INT);
						}
						
						
						if ($stmt2->execute()){
							$pagination = new \classes\Pagination();
							$pagination->totalRow = $single['TotalRow'];
							$pagination->page = $this->page;
							$pagination->itemsPerPage = $this->itemsPerPage;
							$pagination->fetchAllAssoc = $stmt2->fetchAll(PDO::FETCH_ASSOC);
							$data = $pagination->toDataArray();
						} else {
							$data = [
        	    				'status' => 'error',
		    	    	    	'code' => 'RS202',
	        		    	    'message' => CustomHandlers::getreSlimMessage('RS202')
							];	
						}			
			        } else {
	    			    $data = [
        	    		    'status' => 'error',
		    	    	    'code' => 'RS601',
        				    'message' => CustomHandlers::getreSlimMessage('RS601')
						];
		            }          	   	
				} else {
					$data = [
    	    			'status' => 'error',
						'code' => 'RS202',
	    			    'message' => CustomHandlers::getreSlimMessage('RS202')
					];
				}
			} else {
				$data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401')
				];
			}		
        
			return json_encode($data, JSON_PRETTY_PRINT);
	        $this->db= null;
		}

		//User Settings=====================================

		/** 
		 * Determine is first user settings or not 
		 * @return boolean true|false
		 */
		private function isFirstUserSettings(){
			$newusername = strtolower(filter_var($this->username,FILTER_SANITIZE_STRING));
			$r = false;
			$sql = "SELECT a.Username
				FROM user_settings a 
				WHERE a.Username=:username;";
			$stmt = $this->db->prepare($sql);
			$stmt->bindParam(':username', $newusername, PDO::PARAM_STR);
			if ($stmt->execute()) {	
            	if ($stmt->rowCount() == 0){
					$r = true;
    	        }          	   	
			} 		
			return $r;
			$this->db = null;
		}

		/** 
		 * Create new user settings
		 * @return result process in json encoded data
		 */
		private function createUserSettings(){
			if (Auth::validToken($this->db,$this->token,$this->username)){
				$newusername = strtolower(filter_var($this->username,FILTER_SANITIZE_STRING));
				$newfullname = filter_var($this->fullname,FILTER_SANITIZE_STRING);
				$newaccount = Validation::integerOnly($this->account);
				$newbankname = filter_var($this->bankname,FILTER_SANITIZE_STRING);
				$newbankaddress = filter_var($this->bankaddress,FILTER_SANITIZE_STRING);
				try {
	    			$this->db->beginTransaction();
			    	$sql = "INSERT INTO user_settings (Username,Fullname,No_Account,Bank_Name,Bank_Address) 
						VALUES (:username,:fullname,:account,:bankname,:bankaddress);";
					$stmt = $this->db->prepare($sql);
    				$stmt->bindParam(':username', $newusername, PDO::PARAM_STR);
                    $stmt->bindParam(':fullname', $newfullname, PDO::PARAM_STR);
					$stmt->bindParam(':account', $newaccount, PDO::PARAM_STR);
					$stmt->bindParam(':bankname', $newbankname, PDO::PARAM_STR);
					$stmt->bindParam(':bankaddress', $newbankaddress, PDO::PARAM_STR);
					if ($stmt->execute()) {
						$data = [
				    		'status' => 'success',
				    		'code' => 'RS101',
					    	'message' => CustomHandlers::getreSlimMessage('RS101')
						];	
					} else {
			    		$data = [
							'status' => 'error',
			    			'code' => 'RS201',
				    		'message' => CustomHandlers::getreSlimMessage('RS201')
						];
		    		}
			        $this->db->commit();
			    } catch (PDOException $e) {
				    $data = [
    			    	'status' => 'error',
    	    			'code' => $e->getCode(),
	        			'message' => $e->getMessage()
		    		];
	    			$this->db->rollBack();
        		}  
            } else {
                $data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401')
				];
            }

			return json_encode($data, JSON_PRETTY_PRINT);
			$this->db = null;
		}

		/** 
		 * Update data user settings
		 * @return result process in json encoded data
		 */
		private function updateUserSettings(){
            if (Auth::validToken($this->db,$this->token,$this->username)){
				$newusername = strtolower(filter_var($this->username,FILTER_SANITIZE_STRING));
				$newfullname = filter_var($this->fullname,FILTER_SANITIZE_STRING);
				$newaccount = Validation::integerOnly($this->account);
				$newbankname = filter_var($this->bankname,FILTER_SANITIZE_STRING);
				$newbankaddress = filter_var($this->bankaddress,FILTER_SANITIZE_STRING);
	    		    try {
    					$this->db->beginTransaction();
		    			$sql = "UPDATE user_settings a SET a.Fullname=:fullname,a.No_Account=:account,a.Bank_Name=:bankname,a.Bank_Address=:bankaddress
							WHERE a.Username=:username;";
						$stmt = $this->db->prepare($sql);
    					$stmt->bindParam(':username', $newusername, PDO::PARAM_STR);
                    	$stmt->bindParam(':fullname', $newfullname, PDO::PARAM_STR);
						$stmt->bindParam(':account', $newaccount, PDO::PARAM_STR);
						$stmt->bindParam(':bankname', $newbankname, PDO::PARAM_STR);
						$stmt->bindParam(':bankaddress', $newbankaddress, PDO::PARAM_STR);
						if ($stmt->execute()) {
				    		$data = [
					    		'status' => 'success',
					    		'code' => 'RS103',
						    	'message' => CustomHandlers::getreSlimMessage('RS103')
    						];	
						} else {
		    				$data = [
								'status' => 'error',
				    			'code' => 'RS203',
					    		'message' => CustomHandlers::getreSlimMessage('RS203')
							];
	    				}
		    		    $this->db->commit();
				    } catch (PDOException $e) {
				        $data = [
    				    	'status' => 'error',
    	    				'code' => $e->getCode(),
	    	    			'message' => $e->getMessage()
		    			];
		    			$this->db->rollBack();
    	    		}
            } else {
                $data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401')
				];
            }

			return json_encode($data, JSON_PRETTY_PRINT);
			$this->db = null;
        }

		/** 
		 * Save configuration user settings
		 * @return result process in json encoded data
		 */
		public function saveUserSettings(){
			if ($this->isFirstUserSettings()){
				echo $this->createUserSettings();
			} else {
				echo $this->updateUserSettings();
			}
		}

		/** 
		 * Show data user settings as single detail
		 * @return result process in json encoded data
		 */
		public function showSingleUserSettings(){
			if (Auth::validToken($this->db,$this->token)){
				$newusername = strtolower(filter_var($this->username,FILTER_SANITIZE_STRING));
				
				$sql = "SELECT a.Fullname,a.No_Account,a.Bank_Name,a.Bank_Address,a.Username from user_settings a where a.Username=:username;";
				
				$stmt = $this->db->prepare($sql);		
				$stmt->bindParam(':username', $newusername, PDO::PARAM_STR);

				if ($stmt->execute()) {	
    	    	    if ($stmt->rowCount() > 0){
        	   		   	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
						$data = [
			   	            'result' => $results, 
    	    		        'status' => 'success', 
			           	    'code' => 'RS501',
        		        	'message' => CustomHandlers::getreSlimMessage('RS501')
						];
			        } else {
        			    $data = [
            		    	'status' => 'error',
		        		    'code' => 'RS601',
        		    	    'message' => CustomHandlers::getreSlimMessage('RS601')
						];
	    	        }          	   	
				} else {
					$data = [
    	    			'status' => 'error',
						'code' => 'RS202',
	        		    'message' => CustomHandlers::getreSlimMessage('RS202')
					];
				}	
			} else {
				$data = [
    	    		'status' => 'error',
					'code' => 'RS401',
	        	    'message' => CustomHandlers::getreSlimMessage('RS401')
				];
			}
            	
        
			return json_encode($data, JSON_PRETTY_PRINT);
	        $this->db= null;
        }

		//User Withdrawal=====================================

		/** 
		 * Add new withdrawal
		 * @return result process in json encoded data
		 */
		public function addWithdrawal(){
            if (Auth::validToken($this->db,$this->token,$this->adminname)){
				$newusername = strtolower(filter_var($this->username,FILTER_SANITIZE_STRING));
				$newadminname = strtolower(filter_var($this->adminname,FILTER_SANITIZE_STRING));
                $newfullname = filter_var($this->fullname,FILTER_SANITIZE_STRING);
				$newaccount = Validation::integerOnly($this->account);
                $newbankname = filter_var($this->bankname,FILTER_SANITIZE_STRING);
				$newbankaddress = filter_var($this->bankaddress,FILTER_SANITIZE_STRING);
				$newnoreference = filter_var($this->noreference,FILTER_SANITIZE_STRING);
				$newfrombank = filter_var($this->frombank,FILTER_SANITIZE_STRING);
				$newfromname = filter_var($this->fromname,FILTER_SANITIZE_STRING);
				$newamount = Validation::integerOnly($this->amount);
				$newevidence = filter_var($this->evidence,FILTER_SANITIZE_STRING);
				$newdetail = filter_var($this->detail,FILTER_SANITIZE_STRING);
	    	    try {
    				$this->db->beginTransaction();
		    		$sql = "INSERT INTO user_withdrawal (Fullname,No_Account,Bank_Name,Bank_Address,No_Reference,From_Bank,From_Name,Amount,Detail,Image_Evidence,Created_at,Username,Adminname) 
						VALUES (:fullname,:account,:bankname,:bankaddress,:noreference,:frombank,:fromname,:amount,:detail,:evidence,current_timestamp,:username,:adminname);";
					$stmt = $this->db->prepare($sql);
    				$stmt->bindParam(':username', $newusername, PDO::PARAM_STR);
                    $stmt->bindParam(':adminname', $newadminname, PDO::PARAM_STR);
					$stmt->bindParam(':fullname', $newfullname, PDO::PARAM_STR);
					$stmt->bindParam(':evidence', $newevidence, PDO::PARAM_STR);
					$stmt->bindParam(':account', $newaccount, PDO::PARAM_STR);
					$stmt->bindParam(':bankname', $newbankname, PDO::PARAM_STR);
					$stmt->bindParam(':bankaddress', $newbankaddress, PDO::PARAM_STR);
					$stmt->bindParam(':noreference', $newnoreference, PDO::PARAM_STR);
					$stmt->bindParam(':fromname', $newfromname, PDO::PARAM_STR);
					$stmt->bindParam(':frombank', $newfrombank, PDO::PARAM_STR);
					$stmt->bindParam(':amount', $newamount, PDO::PARAM_STR);
					$stmt->bindParam(':detail', $newdetail, PDO::PARAM_STR);
					if ($stmt->execute()) {
			    		$data = [
				    		'status' => 'success',
				    		'code' => 'RS101',
					    	'message' => CustomHandlers::getreSlimMessage('RS101')
    					];	
					} else {
		    			$data = [
							'status' => 'error',
			    			'code' => 'RS201',
				    		'message' => CustomHandlers::getreSlimMessage('RS201')
						];
	    			}
		    	    $this->db->commit();
			    } catch (PDOException $e) {
			        $data = [
    			    	'status' => 'error',
    	    			'code' => $e->getCode(),
	    	    		'message' => $e->getMessage()
		    		];
	    			$this->db->rollBack();
        		}
            } else {
                $data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401')
				];
            }

			return json_encode($data, JSON_PRETTY_PRINT);
			$this->db = null;
        }
		
		/** 
		 * Update data withdrawal
		 * @return result process in json encoded data
		 */
        public function updateWithdrawal(){
            if (Auth::validToken($this->db,$this->token,$this->adminname)){
				$newadminname = strtolower(filter_var($this->adminname,FILTER_SANITIZE_STRING));
                $newfullname = filter_var($this->fullname,FILTER_SANITIZE_STRING);
				$newaccount = Validation::integerOnly($this->account);
                $newbankname = filter_var($this->bankname,FILTER_SANITIZE_STRING);
				$newbankaddress = filter_var($this->bankaddress,FILTER_SANITIZE_STRING);
				$newnoreference = filter_var($this->noreference,FILTER_SANITIZE_STRING);
				$newfrombank = filter_var($this->frombank,FILTER_SANITIZE_STRING);
				$newfromname = filter_var($this->fromname,FILTER_SANITIZE_STRING);
				$newamount = Validation::integerOnly($this->amount);
				$newevidence = filter_var($this->evidence,FILTER_SANITIZE_STRING);
				$newdetail = filter_var($this->detail,FILTER_SANITIZE_STRING);
				$newwithdrawid = Validation::integerOnly($this->withdrawid);
	    	    try {
    				$this->db->beginTransaction();
		    		$sql = "UPDATE user_withdrawal SET Fullname=:fullname,No_Account=:account,Bank_Name=:bankname,Bank_Address=:bankaddress,No_Reference=:noreference,From_Bank=:frombank,
					From_Name=:fromname,Amount=:amount,Image_Evidence=:evidence,Updated_by=:adminname,Detail=:detail
						WHERE WithdrawID=:withdrawid;";
					$stmt = $this->db->prepare($sql);
                    $stmt->bindParam(':adminname', $newadminname, PDO::PARAM_STR);
					$stmt->bindParam(':fullname', $newfullname, PDO::PARAM_STR);
					$stmt->bindParam(':evidence', $newevidence, PDO::PARAM_STR);
					$stmt->bindParam(':account', $newaccount, PDO::PARAM_STR);
					$stmt->bindParam(':bankname', $newbankname, PDO::PARAM_STR);
					$stmt->bindParam(':bankaddress', $newbankaddress, PDO::PARAM_STR);
					$stmt->bindParam(':noreference', $newnoreference, PDO::PARAM_STR);
					$stmt->bindParam(':fromname', $newfromname, PDO::PARAM_STR);
					$stmt->bindParam(':frombank', $newfrombank, PDO::PARAM_STR);
					$stmt->bindParam(':amount', $newamount, PDO::PARAM_STR);
					$stmt->bindParam(':detail', $newdetail, PDO::PARAM_STR);
					$stmt->bindParam(':withdrawid', $newwithdrawid, PDO::PARAM_STR);
					if ($stmt->execute()) {
			    		$data = [
				    		'status' => 'success',
				    		'code' => 'RS103',
					    	'message' => CustomHandlers::getreSlimMessage('RS103')
    					];	
					} else {
		    			$data = [
							'status' => 'error',
			    			'code' => 'RS203',
				    		'message' => CustomHandlers::getreSlimMessage('RS203')
						];
	    			}
		    	    $this->db->commit();
			    } catch (PDOException $e) {
			        $data = [
    			    	'status' => 'error',
    	    			'code' => $e->getCode(),
	    	    		'message' => $e->getMessage()
		    		];
	    			$this->db->rollBack();
        		}
            } else {
                $data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401')
				];
            }

			return json_encode($data, JSON_PRETTY_PRINT);
			$this->db = null;
        }

		/** 
		 * Delete data withdrawal
		 * @return result process in json encoded data
		 */
        public function deleteWithdrawal(){
            if (Auth::validToken($this->db,$this->token,$this->username)){
				if (Auth::getRoleID($this->db,$this->token) == '1'){
					$newwithdrawid = Validation::integerOnly($this->withdrawid);
			
        			try {
	        			$this->db->beginTransaction();
			        	$sql = "DELETE FROM user_withdrawal 
				    		WHERE WithdrawID=:withdrawid;";
				    	$stmt = $this->db->prepare($sql);
            	        $stmt->bindParam(':withdrawid', $newwithdrawid, PDO::PARAM_STR);
						if ($stmt->execute()) {
	    					$data = [
		    					'status' => 'success',
			    				'code' => 'RS104',
				    			'message' => CustomHandlers::getreSlimMessage('RS104')
					    	];	
    					} else {
	    					$data = [
		    					'status' => 'error',
			    				'code' => 'RS204',
			    				'message' => CustomHandlers::getreSlimMessage('RS204')
					    	];
    					}
    				    $this->db->commit();
    	    		} catch (PDOException $e) {
	    				$data = [
			    			'status' => 'error',
		    	    		'code' => $e->getCode(),
				    	    'message' => $e->getMessage()
    	    			];
	    	    		$this->db->rollBack();
    	    		}
				} else {
					$data = [
		    				'status' => 'error',
			    			'code' => 'RS404',
			    			'message' => CustomHandlers::getreSlimMessage('RS404')
				    	];
				}
            } else {
                $data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401')
				];
            }
            
			return json_encode($data, JSON_PRETTY_PRINT);
			$this->db = null;
        }

		/** 
		 * Show all data withdrawal paginated
		 * @return result process in json encoded data
		 */
		public function showAllWithdrawal(){
			if (Auth::validToken($this->db,$this->token)){
				$newusername = strtolower(filter_var($this->username,FILTER_SANITIZE_STRING));
				$newfirstdate = filter_var($this->firstdate,FILTER_SANITIZE_STRING);
				$newlastdate = filter_var($this->lastdate,FILTER_SANITIZE_STRING);
				$search = "%$this->search%";
				if (Auth::getRoleID($this->db,$this->token) != '3'){
					$sqlcountrow = "SELECT count(a.WithdrawID) as TotalRow 
						from user_withdrawal a 
						where date(a.Created_at) between :firstdate and :lastdate and a.Username like :search
						or date(a.Created_at) between :firstdate and :lastdate and a.Fullname like :search
						or date(a.Created_at) between :firstdate and :lastdate and a.No_Reference like :search
						or date(a.Created_at) between :firstdate and :lastdate and a.WithdrawID like :search
						order by a.Created_at desc;";
					$stmt = $this->db->prepare($sqlcountrow);
					$stmt->bindParam(':search', $search, PDO::PARAM_STR);
					$stmt->bindParam(':firstdate', $newfirstdate, PDO::PARAM_STR);
					$stmt->bindParam(':lastdate', $newlastdate, PDO::PARAM_STR);
				} else {
					$sqlcountrow = "SELECT count(a.WithdrawID) as TotalRow 
						from user_withdrawal a 
						where date(a.Created_at) between :firstdate and :lastdate and a.Username = :username
						or date(a.Created_at) between :firstdate and :lastdate and a.Username = :username and a.Fullname like :search
						or date(a.Created_at) between :firstdate and :lastdate and a.Username = :username and a.No_Reference like :search
						or date(a.Created_at) between :firstdate and :lastdate and a.Username = :username and a.WithdrawID like :search
						order by a.Created_at desc;";
					$stmt = $this->db->prepare($sqlcountrow);
					$stmt->bindParam(':search', $search, PDO::PARAM_STR);
					$stmt->bindParam(':username', $newusername, PDO::PARAM_STR);
					$stmt->bindParam(':firstdate', $newfirstdate, PDO::PARAM_STR);
					$stmt->bindParam(':lastdate', $newlastdate, PDO::PARAM_STR);
				}
				

				if ($stmt->execute()) {	
    	        	if ($stmt->rowCount() > 0){
						$single = $stmt->fetch();
						
						// Paginate won't work if page and items per page is negative.
						// So make sure that page and items per page is always return minimum zero number.
						$newpage = Validation::integerOnly($this->page);
						$newitemsperpage = Validation::integerOnly($this->itemsPerPage);
						$limits = (((($newpage-1)*$newitemsperpage) <= 0)?0:(($newpage-1)*$newitemsperpage));
						$offsets = (($newitemsperpage <= 0)?0:$newitemsperpage);

						if (Auth::getRoleID($this->db,$this->token) != '3'){
							// Query Data
							$sql = "SELECT a.Created_at as 'Date_Transaction',a.WithdrawID,a.Detail,a.Username,a.Fullname,a.No_Account,a.Bank_Name,a.Bank_Address,a.No_Reference,a.Amount,a.From_Bank,a.From_Name,a.Image_Evidence,a.Adminname,a.Updated_at,a.Updated_by 
								from user_withdrawal a 
								where date(a.Created_at) between :firstdate and :lastdate and a.Username like :search
								or date(a.Created_at) between :firstdate and :lastdate and a.Fullname like :search
								or date(a.Created_at) between :firstdate and :lastdate and a.No_Reference like :search
								or date(a.Created_at) between :firstdate and :lastdate and a.WithdrawID like :search
								order by a.Created_at desc LIMIT :limpage , :offpage;;";
							$stmt2 = $this->db->prepare($sql);
							$stmt2->bindParam(':search', $search, PDO::PARAM_STR);
							$stmt2->bindParam(':firstdate', $newfirstdate, PDO::PARAM_STR);
							$stmt2->bindParam(':lastdate', $newlastdate, PDO::PARAM_STR);
							$stmt2->bindValue(':limpage', (INT) $limits, PDO::PARAM_INT);
							$stmt2->bindValue(':offpage', (INT) $offsets, PDO::PARAM_INT);
						} else {
							// Query Data
							$sql = "SELECT a.Created_at as 'Date_Transaction',a.WithdrawID,a.Detail,a.Username,a.Fullname,a.No_Account,a.Bank_Name,a.Bank_Address,a.No_Reference,a.Amount,a.From_Bank,a.From_Name,a.Image_Evidence,a.Adminname,a.Updated_at,a.Updated_by 
								from user_withdrawal a 
								where date(a.Created_at) between :firstdate and :lastdate and a.Username = :username
								or date(a.Created_at) between :firstdate and :lastdate and a.Username = :username and a.Fullname like :search
								or date(a.Created_at) between :firstdate and :lastdate and a.Username = :username and a.No_Reference like :search
								or date(a.Created_at) between :firstdate and :lastdate and a.Username = :username and a.WithdrawID like :search
								order by a.Created_at desc LIMIT :limpage , :offpage;;";
							$stmt2 = $this->db->prepare($sql);
							$stmt2->bindParam(':search', $search, PDO::PARAM_STR);
							$stmt2->bindParam(':username', $newusername, PDO::PARAM_STR);
							$stmt2->bindParam(':firstdate', $newfirstdate, PDO::PARAM_STR);
							$stmt2->bindParam(':lastdate', $newlastdate, PDO::PARAM_STR);
							$stmt2->bindValue(':limpage', (INT) $limits, PDO::PARAM_INT);
							$stmt2->bindValue(':offpage', (INT) $offsets, PDO::PARAM_INT);
						}
						
						
						if ($stmt2->execute()){
							$pagination = new \classes\Pagination();
							$pagination->totalRow = $single['TotalRow'];
							$pagination->page = $this->page;
							$pagination->itemsPerPage = $this->itemsPerPage;
							$pagination->fetchAllAssoc = $stmt2->fetchAll(PDO::FETCH_ASSOC);
							$data = $pagination->toDataArray();
						} else {
							$data = [
        	    				'status' => 'error',
		    	    	    	'code' => 'RS202',
	        		    	    'message' => CustomHandlers::getreSlimMessage('RS202')
							];	
						}			
			        } else {
	    			    $data = [
        	    		    'status' => 'error',
		    	    	    'code' => 'RS601',
        				    'message' => CustomHandlers::getreSlimMessage('RS601')
						];
		            }          	   	
				} else {
					$data = [
    	    			'status' => 'error',
						'code' => 'RS202',
	    			    'message' => CustomHandlers::getreSlimMessage('RS202')
					];
				}
			} else {
				$data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401')
				];
			}		
        
			return json_encode($data, JSON_PRETTY_PRINT);
	        $this->db= null;
		}

		//REVIEW=====================================

		/** 
		 * Determine is user are never review 
		 * @return boolean true|false
		 */
		private function isUserNeverReview(){
			$newbookid = Validation::integerOnly($this->bookid);
			$newusername = strtolower(filter_var($this->username,FILTER_SANITIZE_STRING));
			$r = false;
			$sql = "SELECT a.Username
				FROM book_review a 
				WHERE a.Username=:username and a.BookID=:bookid;";
			$stmt = $this->db->prepare($sql);
			$stmt->bindParam(':username', $newusername, PDO::PARAM_STR);
			$stmt->bindParam(':bookid', $newbookid, PDO::PARAM_STR);
			if ($stmt->execute()) {	
            	if ($stmt->rowCount() == 0){
					$r = true;
    	        }          	   	
			} 		
			return $r;
			$this->db = null;
		}

		/** 
		 * Add new review
		 * @return result process in json encoded data
		 */
        public function addReview(){
            if (Auth::validToken($this->db,$this->token)){
				if ($this->isUserNeverReview()){
					$newusername = strtolower(filter_var($this->username,FILTER_SANITIZE_STRING));
                    $newdetail = htmlspecialchars($this->detail);
					$newbookid = Validation::integerOnly($this->bookid);
	    		    try {
    	    			$this->db->beginTransaction();
	    	    		$sql = "INSERT INTO book_review (BookID,Detail,Username,StatusID,Created_at) 
		    	    		VALUES (:bookid,:detail,:username,'3',current_timestamp);";
					    $stmt = $this->db->prepare($sql);
    					$stmt->bindParam(':detail', $newdetail, PDO::PARAM_STR);
                        $stmt->bindParam(':bookid', $newbookid, PDO::PARAM_STR);
						$stmt->bindParam(':username', $newusername, PDO::PARAM_STR);
		    			if ($stmt->execute()) {
			    			$data = [
				    			'status' => 'success',
					    		'code' => 'RS101',
						    	'message' => CustomHandlers::getreSlimMessage('RS101')
    						];	
	    				} else {
		    				$data = [
			    				'status' => 'error',
				    			'code' => 'RS201',
					    		'message' => CustomHandlers::getreSlimMessage('RS201')
    						];
	    				}
		    		    $this->db->commit();
			        } catch (PDOException $e) {
				        $data = [
    				    	'status' => 'error',
    	    				'code' => $e->getCode(),
	    	    			'message' => $e->getMessage()
		    	    	];
	    	    		$this->db->rollBack();
        			}
				} else {
					$data = [
    				    'status' => 'error',
    	    			'code' => 'RS917',
	    	    		'message' => CustomHandlers::getreSlimMessage('RS917')
		    	    ];
				}
            } else {
                $data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401')
				];
            }

			return json_encode($data, JSON_PRETTY_PRINT);
			$this->db = null;
        }

		/** 
		 * Update data review
		 * @return result process in json encoded data
		 */
        public function updateReview(){
            if (Auth::validToken($this->db,$this->token)){
                if (Auth::getRoleID($this->db,$this->token) == '1'){
                    $newusername = strtolower(filter_var($this->username,FILTER_SANITIZE_STRING));
                    $newdetail = htmlspecialchars($this->detail);
					$newstatusid = Validation::integerOnly($this->statusid);
					$newreviewid = Validation::integerOnly($this->reviewid);
                    
        			try {
	        			$this->db->beginTransaction();
		        		$sql = "UPDATE book_review SET Detail=:detail,StatusID=:status,Updated_by=:username  
			        		WHERE ReviewID=:reviewid;";
    					$stmt = $this->db->prepare($sql);
	    				$stmt->bindParam(':detail', $newdetail, PDO::PARAM_STR);
                        $stmt->bindParam(':username', $newusername, PDO::PARAM_STR);
                        $stmt->bindParam(':reviewid', $newreviewid, PDO::PARAM_STR);
						$stmt->bindParam(':status', $newstatusid, PDO::PARAM_STR);
				    	if ($stmt->execute()) {
					    	$data = [
						    	'status' => 'success',
    							'code' => 'RS103',
	    						'message' => CustomHandlers::getreSlimMessage('RS103')
		    				];	
			    		} else {
				    		$data = [
					    		'status' => 'error',
						    	'code' => 'RS203',
							    'message' => CustomHandlers::getreSlimMessage('RS203')
    						];
	    				}
		    		    $this->db->commit();
    			    } catch (PDOException $e) {
	    			    $data = [
    	    				'status' => 'error',
	    	    			'code' => $e->getCode(),
		    	    		'message' => $e->getMessage()
			    	    ];
    				    $this->db->rollBack();
        			}
                } else {
                    $data = [
    	    			'status' => 'error',
	    				'code' => 'RS404',
            	    	'message' => CustomHandlers::getreSlimMessage('RS404')
			    	];
                }
            } else {
                $data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401')
				];
            }

			return json_encode($data, JSON_PRETTY_PRINT);
			$this->db = null;
        }

		/** 
		 * Delete data review
		 * @return result process in json encoded data
		 */
        public function deleteReview(){
            if (Auth::validToken($this->db,$this->token,$this->username)){
                if (Auth::getRoleID($this->db,$this->token) == '1'){
                    $newreviewid = Validation::integerOnly($this->reviewid);
			
        			try {
	        			$this->db->beginTransaction();
		        		$sql = "DELETE FROM book_review 
			        		WHERE ReviewID=:reviewid;";
				    	$stmt = $this->db->prepare($sql);
                        $stmt->bindParam(':reviewid', $newreviewid, PDO::PARAM_STR);
    					if ($stmt->execute()) {
	    					$data = [
		    					'status' => 'success',
			    				'code' => 'RS104',
				    			'message' => CustomHandlers::getreSlimMessage('RS104')
					    	];	
    					} else {
	    					$data = [
		    					'status' => 'error',
			    				'code' => 'RS204',
				    			'message' => CustomHandlers::getreSlimMessage('RS204')
					    	];
    					}
	    			    $this->db->commit();
    	    		} catch (PDOException $e) {
	    	    		$data = [
		    	    		'status' => 'error',
			    	    	'code' => $e->getCode(),
				    	    'message' => $e->getMessage()
        				];
	        			$this->db->rollBack();
    	    		}
                } else {
                    $data = [
    	    			'status' => 'error',
	    				'code' => 'RS404',
            	    	'message' => CustomHandlers::getreSlimMessage('RS404')
			    	];
                }
            } else {
                $data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401')
				];
            }
            
			return json_encode($data, JSON_PRETTY_PRINT);
			$this->db = null;
        }

		/** 
		 * Show all data review
		 * @return result process in json encoded datas
		 */
        public function showReview(){
				$newbookid = Validation::integerOnly($this->bookid);
				$sql = "SELECT a.ReviewID,a.BookID,case 
					when a.StatusID = '20' then 'Your review has been hidden by admin because indicated as spam.'
					when a.StatusID = '38' then 'Your review has been removed by admin because inappropriate.' else a.Detail end as 'Detail',a.StatusID,a.Created_at,a.Username,b.Avatar,a.Updated_at,a.Updated_by
					FROM book_review a
					inner join user_data b on a.Username = b.Username
					WHERE a.BookID = :bookid
					ORDER BY a.Created_at DESC";
				
				$stmt = $this->db->prepare($sql);	
				$stmt->bindValue(':bookid', $newbookid, PDO::PARAM_STR);	

				if ($stmt->execute()) {	
    	    	    if ($stmt->rowCount() > 0){
        	   		   	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
						$data = [
			   	            'result' => $results, 
    	    		        'status' => 'success', 
			           	    'code' => 'RS501',
        		        	'message' => CustomHandlers::getreSlimMessage('RS501')
						];
			        } else {
        			    $data = [
            		    	'status' => 'error',
		        		    'code' => 'RS601',
        		    	    'message' => CustomHandlers::getreSlimMessage('RS601')
						];
	    	        }          	   	
				} else {
					$data = [
    	    			'status' => 'error',
						'code' => 'RS202',
	        		    'message' => CustomHandlers::getreSlimMessage('RS202')
					];
				}		
        
			return json_encode($data, JSON_PRETTY_PRINT);
	        $this->db= null;
        }

		/** 
		 * Search all data review paginated
		 * @return result process in json encoded data
		 */
		public function searchReviewAsPagination() {
			if (Auth::validToken($this->db,$this->token)){
				if (Auth::getRoleID($this->db,$this->token) == '1'){
					$search = "%$this->search%";
					$sqlcountrow = "SELECT count(a.ReviewID) as TotalRow
					FROM book_review a
					inner join user_data b on a.Username = b.Username
					WHERE a.BookID like :search
					ORDER BY a.Created_at DESC;";
					$stmt = $this->db->prepare($sqlcountrow);
					$stmt->bindValue(':search', $search, PDO::PARAM_STR);
				
					if ($stmt->execute()) {	
    	    	    	if ($stmt->rowCount() > 0){
							$single = $stmt->fetch();
						
							// Paginate won't work if page and items per page is negative.
							// So make sure that page and items per page is always return minimum zero number.
							$newpage = Validation::integerOnly($this->page);
							$newitemsperpage = Validation::integerOnly($this->itemsPerPage);
							$limits = (((($newpage-1)*$newitemsperpage) <= 0)?0:(($newpage-1)*$newitemsperpage));
							$offsets = (($newitemsperpage <= 0)?0:$newitemsperpage);

							// Query Data
							$sql = "SELECT a.ReviewID,a.BookID,a.Detail,a.StatusID,c.Status,a.Created_at,a.Username,b.Avatar,a.Updated_at,a.Updated_by
								FROM book_review a
								inner join user_data b on a.Username = b.Username
								inner join core_status c on a.StatusID=c.StatusID
								WHERE a.BookID like :search
								ORDER BY a.Created_at DESC LIMIT :limpage , :offpage;";
							$stmt2 = $this->db->prepare($sql);
							$stmt2->bindValue(':search', $search, PDO::PARAM_STR);
							$stmt2->bindValue(':limpage', (INT) $limits, PDO::PARAM_INT);
							$stmt2->bindValue(':offpage', (INT) $offsets, PDO::PARAM_INT);
						
							if ($stmt2->execute()){
								$pagination = new \classes\Pagination();
								$pagination->totalRow = $single['TotalRow'];
								$pagination->page = $this->page;
								$pagination->itemsPerPage = $this->itemsPerPage;
								$pagination->fetchAllAssoc = $stmt2->fetchAll(PDO::FETCH_ASSOC);
								$data = $pagination->toDataArray();
							} else {
								$data = [
        	    		    		'status' => 'error',
		    	    		    	'code' => 'RS202',
	        			    	    'message' => CustomHandlers::getreSlimMessage('RS202')
								];	
							}			
				        } else {
    	    			    $data = [
        	    		    	'status' => 'error',
		    	    		    'code' => 'RS601',
        			    	    'message' => CustomHandlers::getreSlimMessage('RS601')
							];
		    	        }          	   	
					} else {
						$data = [
    	    				'status' => 'error',
							'code' => 'RS202',
	        			    'message' => CustomHandlers::getreSlimMessage('RS202')
						];
					}
				} else {
					$data = [
		    			'status' => 'error',
						'code' => 'RS404',
        		    	'message' => CustomHandlers::getreSlimMessage('RS404')
					];
				}
			} else {
				$data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401')
				];
			}		
        
			return json_encode($data, JSON_PRETTY_PRINT);
	        $this->db= null;
		}

		/** 
		 * Get all data Status for Data Review
		 * @return result process in json encoded data
		 */
		public function showOptionReview() {
			if (Auth::validToken($this->db,$this->token)){
				$sql = "SELECT a.StatusID,a.Status
					FROM core_status a
					WHERE a.StatusID = '3' OR a.StatusID = '20' OR a.StatusID = '38'
					ORDER BY a.Status ASC";
				
				$stmt = $this->db->prepare($sql);		
				$stmt->bindParam(':token', $this->token, PDO::PARAM_STR);

				if ($stmt->execute()) {	
    	    	    if ($stmt->rowCount() > 0){
        	   		   	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
						$data = [
			   	            'result' => $results, 
    	    		        'status' => 'success', 
			           	    'code' => 'RS501',
        		        	'message' => CustomHandlers::getreSlimMessage('RS501')
						];
			        } else {
        			    $data = [
            		    	'status' => 'error',
		        		    'code' => 'RS601',
        		    	    'message' => CustomHandlers::getreSlimMessage('RS601')
						];
	    	        }          	   	
				} else {
					$data = [
    	    			'status' => 'error',
						'code' => 'RS202',
	        		    'message' => CustomHandlers::getreSlimMessage('RS202')
					];
				}
			} else {
				$data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401')
				];
			}		
        
			return json_encode($data, JSON_PRETTY_PRINT);
	        $this->db= null;
		}

		/** 
		 * Show all data available tags
		 * @return result process in json encoded data
		 */
        public function showAllTags(){
				$sql = "SELECT SPLIT_SORT(x.`values`, ',') as Tags from (
						select group_concat(distinct trim(substring_index(substring_index(t.Tags, ',', n.n), ',', -1)) separator ',' ) as `values`
						from book_release t 
						cross join (select 1 as n union all select 2 union all select 3) n
						order by `values`
					) x;";
				$stmt = $this->db->prepare($sql);		

				if ($stmt->execute()) {	
    	    	    if ($stmt->rowCount() > 0){
						$datares = "";
						while($redata = $stmt->fetch()) {
							$return_arr = null;
							$names = $redata['Tags'];	
							$named = preg_split( "/[;,@#]/", $names );
							foreach($named as $name){
								if ($name != null){$return_arr[] = trim($name);}
							}
							$datares .= '{"Tags_Inline":'.json_encode($redata['Tags']).',
								"Tags": '.json_encode($return_arr).'},';
						}
						$datares = substr($datares, 0, -1);
						$data = [
			   	            'result' => json_decode($datares), 
    	    		        'status' => 'success', 
			           	    'code' => 'RS501',
        		        	'message' => CustomHandlers::getreSlimMessage('RS501')
						];
			        } else {
        			    $data = [
            		    	'status' => 'error',
		        		    'code' => 'RS601',
        		    	    'message' => CustomHandlers::getreSlimMessage('RS601')
						];
	    	        }          	   	
				} else {
					$data = [
    	    			'status' => 'error',
						'code' => 'RS202',
	        		    'message' => CustomHandlers::getreSlimMessage('RS202')
					];
				}		
        
			return json_encode($data, JSON_PRETTY_PRINT);
	        $this->db= null;
        }
    }
