$getcolms = $db->get_results("SHOW FULL COLUMNS FROM $tablename");
				if($getcolms)
				{
								foreach($getcolms as $getcolm)
								{ 
										print_r($getcolm);
										if($getcolm->Field == $id)
										{
												echo $getcolm->Comment;
											}else{
													//	print_r($getcolm->Field);
														$field12 = $getcolm->Field;
																			
																				foreach($db->get_col("SHOW TABLES", 0) as $table_name)
																				{
																								if($table_name != $tablename)
																								{
																									$getfirstcolumn = $db->get_row("SHOW FULL COLUMNS FROM $table_name WHERE Field = '$getcolm->Field' AND Extra = 'auto_increment' ");
																									//echo $getfirstcolumn;
																										if($getfirstcolumn)
																										{
																											
																										//print_r($getfirstcolumn);
																											$getresults = $db->get_results("SHOW FULL COLUMNS FROM $table_name");
																											foreach($getresults as $getresult)
																											{
																												//echo $field12;
																												echo $getresult->Comment;
																												//echo '<pre>';
																												//print_r($getresult);
																												//echo '</pre>';
																												
																												break 1;
																												}
															
																											}
																								}
																				}
										
										   // echo "The string '$findme' was found <br />";
										  }
									}
							}