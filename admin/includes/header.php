<?php
//include_once('conn.php');
//include_once('function.php');
include_once('defination.php');

if(isset($_POST['SaveAndCont'] ))
{
					$type = $_POST['table'];
					if(isset($_POST['id']))
					{
					
									if($_POST['seo_table'] != '')
									{
													$seo_table='seo_detail';
									}
									else
									{
													$seo_table=null;
									}
									
									$id =$_POST['id'];
									//if($type !='gallery' || $type != 'tour_country' || $type != 'tour_category' || $type != 'tour_destination')
							/*else*/
							$update=Form_Update($type,$id,$seo_table);
						if($type !='gallery' )
									{
														if($update == '1')
														{
																//echo 'in update';
																$kind = $_GET['kind'];
																$method = $_GET['method'];
																$ty = $_GET['type'];
															header('location:index.php?option=component&kind='.$kind.'&method='.$method.'&process=add&type='.$ty.'&insert=2');	
														}
									}else{
										
										
										}
					}
					else
					{
								if($_POST['seo_table']!='')
								{
								$seo_table='seo_detail';
								}
								else
								{ 
								$seo_table=null;
								}
								
						if(isset($_GET['b_id']))
						{
							
							$id = $_GET['b_id'];	
								$update=Form_Update($type,$id,$seo_table);
										if($update == '1')
										{
												$kind = $_GET['kind'];
												$method = $_GET['method'];
												$ty = $_GET['type'];
												if($type =='batch_table')
												{
											 					header('location:index.php?option=component&kind='.$kind.'&method='.$method.'&process=add&type='.$ty);
												}
											
										}
							
						}elseif($type == 'tour' && isset($_GET['process']) == 'add' && $_GET['t_id'] == '' && $_GET['ins'] == '')
							{
								
										//echo 'run tour insert code in save and cont';		
										$insert_tour = Form_insert($type,$seo_table,$_POST);
									if($insert_tour)
									{
													$kind = $_GET['kind'];
													$ty = $_GET['type'];
													$process = $_GET['process'];
													$ins = '1';  // for insert
													header('location:index.php?option=component&kind='.$kind.'&method=tour&process='.$process.'&type='.$ty.'&t_id='.$insert_tour.'&insert=1&ins='.$ins);	
													//select instructor header code	 
											}						
										//header('location:index.php?option=component&kind=tour&method=add_tour&process=select_country&type=tour&t_id='.$insert);
							}elseif($type == 'tour' && isset($_GET['process']) == 'add' && isset($_GET['t_id']) != null)
							{
								 $type = $_GET['type'];
								 $id = $_GET['t_id'];
								 	$seo_table='seo_detail';
									$update = Form_Update($type,$id,$seo_table);									
									if($update == '1')
									{
												//echo 'run tour update code in saveand cont';
												$ins = '2';  // for update
											 header('location:index.php?option=component&kind=tour&method=tour&process=add&type=tour&insert=2&ins=2');
									}	
							}elseif($type == 'tour_country' && isset($_GET['process']) == 'select_country' && isset($_GET['t_id']) != null || isset($_GET['id']) != '')
							{
										$t_id = $_GET['t_id'];
								 header('location:index.php?option=component&kind=tour&method=add_tour&process=select_category&type=tour&insert=22&t_id='.$t_id);
							}
							elseif($type == 'tour_category' && isset($_GET['process']) == 'select_category' && isset($_GET['t_id']) != null || isset($_GET['id']) != '')
							{
										$t_id = $_GET['t_id'];
								 header('location:index.php?option=component&kind=tour&method=add_tour&process=select_destination&type=tour&insert=33&t_id='.$t_id);
							}
							elseif($type == 'tour_destination' && isset($_GET['process']) == 'select_destination' && isset($_GET['t_id']) != null || isset($_GET['id']) != '')
							{
										$t_id = $_GET['t_id'];
								 header('location:index.php?option=component&kind=tour&method=add_tour&process=schedule_type&type=tour&insert=44&t_id='.$t_id);
							}
							else{								
														
											$insert=Form_insert($type,$seo_table,$_POST);
										}
				
						if($insert)
					{
						$kind = $_GET['kind'];
						$method = $_GET['method'];
						$ty = $_GET['type'];
					header('location:index.php?option=component&kind='.$kind.'&method='.$method.'&process=add&type='.$ty.'&insert=1');	
					}
					//echo '$insert is:'.$insert;
					}
}


if(isset($_POST['saveandclose'] ))
{
					$type = $_POST['table'];
					if(isset($_POST['id']))
					{
					
									if($_POST['seo_table']!='')
									{
													$seo_table='seo_detail';
									}
									else
									{
													$seo_table=null;
									}
									
									$id =$_POST['id'];
									//if($type !='gallery' || $type != 'tour_country' || $type != 'tour_category' || $type != 'tour_destination')
									if($type !='gallery' )
									{
														$update=Form_Update($type,$id,$seo_table);
															
														if($update == '1')
														{
															$kind = $_GET['kind'];
															$method = $_GET['method'];
															$ty = $_GET['type'];
														header('location:index.php?option=component&kind='.$kind.'&method='.$method.'&process=view&type='.$ty.'&insert=2');	
														}
									//echo $update;
									}
					}
					else
					{
								if($_POST['seo_table']!='')
								{
								$seo_table='seo_detail';
								}
								else
								{ 
								$seo_table=null;
								}
								
								
								if(isset($_GET['b_id']) && $_GET['process'] == 'add' && isset($_GET['insert']) != '')
								{
									//echo 'run discount value update123';
									$id = $_GET['b_id'];	
										$update=Form_Update($type,$id,$seo_table);
												if($update == '1')
												{
														$kind = $_GET['kind'];
														$method = $_GET['method'];
														$ty = $_GET['type'];
														if($type =='batch_table')
														{
													 					header('location:index.php?option=component&kind='.$kind.'&method='.$method.'&process=view&type='.$ty.'&insert=2&b_id='.$id);
														}
													
												}
									
								}elseif(isset($_GET['b_id']) && $_GET['insert'] == '11' && $_GET['bfid'] != '')
								{
									
									
												//echo 'run batch fee update code';
												$b_id= $_POST['b_id'];
												$userid= $_POST['userid'];
												//print_r($_POST);
												foreach($_POST as $key=>$value)
												{
																//echo 'key '.$key.'<br />';
																$currency= $db->get_results("SELECT * FROM currency");
																foreach($currency as $cu)
																{
																				$batch_charges= $db->get_results("SELECT * FROM batch_charges_type");
																				foreach($batch_charges as $fee)
																				{
																			
																				//echo'bc_id : '.$fee->bc_id.'cr_id : '.$cu->cr_id. 'value :  '.$value[$cu->cr_id][$fee->bc_id].'<br />';
																				
																				$values=$value[$cu->cr_id][$fee->bc_id];
																				//if($values!='')
																				//{
																				$batch_fees= $db->get_row("SELECT * FROM batch_fee WHERE (b_id='$b_id' AND bc_id='$fee->bc_id') AND (bf_cr_id='$cu->cr_id')");
																							if($batch_fees)
																							{
																										//echo'value'.$batch_fees->bf_value.'<br />';
																										$date=date('Y-m-d H:i:s');
																										if($batch_fees->bf_value==$values)
																										{
																													//echo 'value '.$values.'<br />';
																										}
																										else
																										{
																													//echo 'value'.$batch_fees->bf_value.'new value'.$values.'<br />';
																													$original_value=$batch_fees->bf_value;
																													
																													$admin_count= $db->get_row("SELECT * FROM admin_change WHERE (type='batch_fee' AND type_id='$batch_fees->bf_id') AND(field_change='bf_value') ORDER BY ac_id DESC");
																													if($admin_count)
																													{
																																	$change_count=$admin_count->change_count + 1;
																													}
																													else
																													{
																																		$change_count='1';
																													}
																													$insert_admin= $db->query("INSERT INTO admin_change VALUES('','batch_fee','$batch_fees->bf_id','bf_value','$original_value','$values','$date','$userid','$change_count')");
																													
																										}
																										
																										$update= $db->query("UPDATE batch_fee SET bf_value='$values' WHERE( b_id='$b_id' AND bc_id='$fee->bc_id') AND (bf_cr_id='$cu->cr_id')");
																							}
																							else
																							{
																							
																							}
																				
																			
																				}
																}
																break 1;
												}
									
												if($update)
												{
															$bf_id = '2';
															header('location:index.php?option=component&kind=batch&method=add_batch&process=batch_fee&type=batch_table&insert=2&b_id='.$b_id.'&bfid=2');
												}
									
								}elseif(isset($_GET['b_id']) && $_GET['insert'] == '11')
								{
															
													//run batch fee insert code
												$b_id= $_POST['b_id'];
				
												if(isset($_GET['bfid']) == '')
												{
																		foreach($_POST as $key=>$value)
																		{
																		//echo 'key '.$key.'<br />';
																		$currency= $db->get_results("SELECT * FROM currency");
																		foreach($currency as $cu)
																		{
																		$batch_charges= $db->get_results("SELECT * FROM batch_charges_type");
																		foreach($batch_charges as $fee)
																		{
																		//print_r($value[2]);
																		//echo'bc_id'.$fee->bc_id.'cr_id'.$cu->cr_id. 'value '.$value[$cu->cr_id][$fee->bc_id].'<br />';
																		$values=$value[$cu->cr_id][$fee->bc_id];
																		if($values!='')
																		{
																					$batch_fee= $db->query("INSERT INTO batch_fee VALUES('','$fee->bc_id','$values','$cu->cr_id','$b_id')");
																					
																		}
																		//header('location:index.php?option=component&kind=batch&method=add_batch&process=discount_value&type=batch_table&insert=1&b_id='.$b_id.'&bfid='.$bf_id);
																		}
																		
																		}
																		break 1;
																		}
																		
																		if($batch_fee)
																		{
																		$bf_id = '1';
																								header('location:index.php?option=component&kind=batch&method=batch&process=add&type=batch_table&insert=11');
																		}
												
												}
									
								}elseif(isset($_GET['b_id']) && $_GET['insert'] == '22' && $_GET['bdid'] != '')
								{
												//echo 'run discount value update';
												$b_id= $_GET['b_id'];
												//print_r($_POST);
												$userid= $_POST['userid'];
												foreach($_POST as $key=>$value)
												{
																//echo 'key '.$key.'<br />';
																$discount_type = $db->get_results("SELECT * FROM discount_type");
																//print_r($discount_type);
																foreach($discount_type as $offer)
																{
																				//print_r($offer);
																			///print_r($value[2]);
																			//echo'dt_id'.$offer->dt_id. 'value '.$value[$offer->dt_id].'<br />';
																			$values=$value[$offer->dt_id];
																			$discount_value = $db->get_row("SELECT * FROM discount_value WHERE dv_bid = '$b_id' AND dt_id = '$offer->dt_id'");
																			if($discount_value)
																			{
																			
																							if($discount_value->dv_value == $values)
																							{
																							
																							}
																							else
																							{
																											//echo'value'.$discount_value->dv_value.'new value'.$values.'<br />';
																											$original_value= $discount_value->dv_value;
																											$date=date('Y-m-d H:i:s');
																											
																											$admin_count= $db->get_row("SELECT * FROM admin_change WHERE (type='discount_value' AND type_id='$discount_value->dv_id') AND(field_change='dv_value') ORDER BY ac_id DESC");
																											if($admin_count)
																											{
																															$change_count=$admin_count->change_count + 1;
																											}
																											else
																											{
																																$change_count='1';
																											}
																											$insert_admin= $db->query("INSERT INTO admin_change VALUES('','discount_value','$discount_value->dv_id','dv_value','$original_value','$values','$date','$userid','$change_count')");
																											
																							}
																							
																			$update_discount= $db->query("UPDATE discount_value SET dv_value='$values' WHERE dv_bid = '$b_id' AND dt_id='$offer->dt_id' ");
																			}
																			else
																			{
																			//$batch_fee= $db->query("INSERT INTO discount_value VALUES('','$offer->dt_id','$values','$b_id')");
																			
																			}
																			
																}
																break 1;
												}
										
										if($update_discount)
										{
												$bd_id = '2';
												header('location:index.php?option=component&kind=batch&method=batch&process=view&type=batch_table&insert=22');
										}
												
								
								}elseif(isset($_GET['b_id']) && $_GET['insert'] == '22')
								{
											//echo 'run discount value insert';
												//run discount value insert
												$b_id= $_POST['b_id'];
												if(isset($_GET['bdid']) == '')
												{
																//print_r($_POST);
																foreach($_POST as $key=>$value)
																{
																				//echo 'key '.$key.'<br />';
																				$discount_type= $db->get_results("SELECT * FROM discount_type");
																				foreach($discount_type as $offer)
																				{
																								//print_r($value[2]);
																								//echo'dt_id'.$offer->dt_id. 'value '.$value[$offer->dt_id].'<br />';
																								$values=$value[$offer->dt_id];
																								if($values!='')
																								{
																								$batch_fee= $db->query("INSERT INTO discount_value VALUES('','$offer->dt_id','$values','$b_id')");
																								}
																								//header('location:index.php?option=component&kind=batch&method=add_batch&process=select_instructer&type=batch_table&tmpl=default&b_id='.$b_id);
																				}
																				break 1;
																}
																
																if($batch_fee)
																{
																			$bf_id = '1';
																			header('location:index.php?option=component&kind=batch&method=batch&process=add&type=batch_table&insert=1');
																}
													}
												
						}elseif($_GET['process'] == 'select_instructer'  && $_GET['insert'] == '33' && isset($_GET['b_id']) != '' && isset($_GET['ins']) == '')
						{
									//echo 'run select instructor insert code';
									$insert_instructor = Form_insert($type,$seo_table,$_POST);
									if($insert_instructor)
									{
									$kind = $_GET['kind'];
													$method = $_GET['method'];
													$ty = $_GET['type'];
													$process = $_GET['process'];
													$ins = '1';  // for insert
													$bid = $_GET['b_id'];
													header('location:index.php?option=component&kind='.$kind.'&method=batch&process=view&type='.$ty.'&insert=33');	
													//select instructor header code	 
											}		
							
						}elseif($_GET['process'] == 'select_instructer' && $_GET['insert'] == '33' && isset($_GET['b_id']) != '' && isset($_GET['ins']))
						{
									//echo 'run select instructor update code';
									$b_id= $_POST['b_id'];
									//print_r($_POST);
									$inst_id= $_POST['instructer_id'];
									$userid = $_POST['userid'];
									$inst_idd='';
									if($inst_id!='')
									{
									foreach($inst_id as $instruct_id)
									{
									
									$inst_idd.=$instruct_id.',';
									} }
									
									$batch_instructer= $db->get_row("SELECT * FROM batch_instructer WHERE b_id='$b_id'");
									if($batch_instructer->instructer_id==$inst_idd)
									{
									//echo 'value equal';
									}
									else
									{
									
									$original_value= $batch_instructer->instructer_id;
									$date=date('Y-m-d H:i:s');
									
									$admin_count= $db->get_row("SELECT * FROM admin_change WHERE (type='batch_instructer' AND type_id='$batch_instructer->bi_id') AND(field_change='instructer_id') ORDER BY ac_id DESC");
									if($admin_count)
									{
									$change_count=$admin_count->change_count + 1;
									}
									else
									{
									$change_count='1';
									}
									$insert_admin= $db->query("INSERT INTO admin_change VALUES('','batch_instructer','$batch_instructer->bi_id','instructer_id','$original_value','$inst_idd','$date','$userid','$change_count')");
									}
									$update_inst = $db->query("UPDATE batch_instructer SET instructer_id='$inst_idd' WHERE b_id='$b_id'");
									if($update_inst)
									{
											$kind = $_GET['kind'];
													$method = $_GET['method'];
													$ty = $_GET['type'];
													$process = $_GET['process'];
													$b_id= $_POST['b_id'];
													$ins = '2';  // for insert
													header('location:index.php?option=component&kind='.$kind.'&method=batch&process=view&type='.$ty.'&insert=33');	
										}
							
						}	elseif($_GET['process'] == 'pre_camp_value' && $_GET['insert'] == '44' && $_GET['b_id'] != '' && $_GET['ins'] == '')
						{
									//echo 'in else pre camp value update code';		
									//echo 'run pre camp value insert code';
									$insert_camp = Form_insert($type,$seo_table,$_POST);
									if($insert_camp)
									{
									$kind = $_GET['kind'];
													$method = $_GET['method'];
													$ty = $_GET['type'];
													$process = $_GET['process'];
													$ins = '1';  // for insert
													$bid = $_GET['b_id'];
													header('location:index.php?option=component&kind='.$kind.'&method=batch&process=view&type='.$ty.'&insert=44');	
													//select instructor header code	 
											}	
							
							
							}elseif($_GET['process'] == 'pre_camp_value' && isset($_GET['insert']) == '44' && isset($_GET['b_id']) != '' && isset($_GET['ins']) != '')
							{
							
										//echo 'run pre camp value update code';
										$b_id= $_GET['b_id'];
										$pre_camp_id = current($_POST['pc_id']);
										//echo 'pre campid'.$pre_camp_id ;
										$userid= $_POST['userid'];
										$date11= $_POST['date_pre'];
										$time= $_POST['time_pre'];
											$date = date('Y-m-d',strtotime($date11));
										$pre_camp= $db->get_row("SELECT * FROM pre_camp_value WHERE batch_id='$b_id'");
										if($pre_camp->pc_id != $pre_camp_id)
										{
										
										
										
										$original_value= $pre_camp->pc_id;
										$date_change=date('Y-m-d H:i:s');
										
										$admin_count= $db->get_row("SELECT * FROM admin_change WHERE (type='pre_camp_value' AND type_id='$pre_camp->pcv_id') AND(field_change='pc_id') ORDER BY ac_id DESC");
										if($admin_count)
										{
										$change_count=$admin_count->change_count + 1;
										}
										else
										{
										$change_count='1';
										}
										$insert_admin= $db->query("INSERT INTO admin_change VALUES('','pre_camp_value','$pre_camp->pcv_id','pc_id','$original_value','$pre_camp_id','$date_change','$userid','$change_count')");
										
										
										}
										
										if($pre_camp->date_pre != $date)
										{
										
										
										
										$original_value= $pre_camp->date_pre;
										$date_change=date('Y-m-d H:i:s');
										
										$admin_count= $db->get_row("SELECT * FROM admin_change WHERE (type='pre_camp_value' AND type_id='$pre_camp->pcv_id') AND(field_change='date_pre') ORDER BY ac_id DESC");
										if($admin_count)
										{
										$change_count=$admin_count->change_count + 1;
										}
										else
										{
										$change_count='1';
										}
										$insert_admin= $db->query("INSERT INTO admin_change VALUES('','pre_camp_value','$pre_camp->pcv_id','date_pre','$original_value','$date','$date_change','$userid','$change_count')");
										
										
										
										}
										
										if($pre_camp->time_pre!=$time)
										{
										
										
										
										
										
										$original_value= $pre_camp->time_pre;
										$date_change=date('Y-m-d H:i:s');
										
										$admin_count= $db->get_row("SELECT * FROM admin_change WHERE (type='pre_camp_value' AND type_id='$pre_camp->pcv_id') AND(field_change='time_pre') ORDER BY ac_id DESC");
										if($admin_count)
										{
										$change_count=$admin_count->change_count + 1;
										}
										else
										{
										$change_count='1';
										}
										$insert_admin= $db->query("INSERT INTO admin_change VALUES('','pre_camp_value','$pre_camp->pcv_id','time_pre','$original_value','$time','$date_change','$userid','$change_count')");
										
										}
										
										
										$update_precamp = $db->query("UPDATE pre_camp_value SET pc_id ='$pre_camp_id',date_pre='$date',time_pre='$time' WHERE batch_id='$b_id'");
									if($update_precamp)
									{
													$kind = $_GET['kind'];
													$ty = $_GET['type'];
													header('location:index.php?option=component&kind='.$kind.'&method=batch&process=view&type='.$ty.'&insert=44');	
													//select instructor header code	 
											}	
							
							
							}elseif($type == 'tour' && isset($_GET['process']) == 'add' && $_GET['t_id'] == '' && $_GET['ins'] == '')
							{
								
										//echo 'run tour insert code';		
										$insert_tour = Form_insert($type,$seo_table,$_POST);
									if($insert_tour)
									{
													$kind = $_GET['kind'];
													$ty = $_GET['type'];
													$process = $_GET['process'];
													$ins = '1';  // for insert
													header('location:index.php?option=component&kind='.$kind.'&method=tour&process='.$process.'&type='.$ty.'&id='.$insert_tour.'&insert=1&ins='.$ins);	
													//select instructor header code	 
											}						
										//header('location:index.php?option=component&kind=tour&method=add_tour&process=select_country&type=tour&t_id='.$insert);
							}elseif($type == 'tour' && isset($_GET['process']) == 'add' && isset($_GET['t_id']) != null)
							{
								
									$type = $_GET['type'];
								 $id = $_GET['t_id'];
								 	$seo_table='seo_detail';								
									$update = Form_Update($type,$id,$seo_table);									
									if($update == '1')
									{
												//echo 'run tour update code';
												$ins = '2';  // for update
											 header('location:index.php?option=component&kind=tour&method=tour&process=view&type=tour&insert=2&ins=2');
									}	
							}	elseif($type == 'tour_country' && $_GET['process'] == 'select_country' && isset($_GET['t_id']) != null && $_GET['ins'] == '')
							{
								
										//echo 'run tour country insert code';	
									$id = $_GET['t_id'];
										$check = $db->get_var("SELECT COUNT(*) FROM tour_country WHERE t_id = '$id' ");
										//echo $check;
										if($check == '1')
										{
													 $id = $_POST['tc_id'];
														$update_tour_country = Form_Update($type,$id,$seo_table);		
														if($update_tour_country == '1')
														{
																	$t_id = $_GET['t_id'];
																		$kind = $_GET['kind'];
																		$ty = $_GET['type'];
																		$process = $_GET['process'];
																	$ins = '2';  // for update
																 header('location:index.php?option=component&kind=tour&method=tour&process=view&type=tour&insert=2&ins=2');
														}	
											
											}else{										
															$insert_tour1 = Form_insert($type,$seo_table,$_POST);
															if($insert_tour1)
															{
																			$t_id = $_GET['t_id'];
																			$kind = $_GET['kind'];
																			$ty = $_GET['type'];
																			$process = $_GET['process'];
																			$ins = '1';  // for insert
																			header('location:index.php?option=component&kind=tour&method=tour&process=view&type=tour&insert=1&ins=1');	
																			//select instructor header code	 
																}	
										}					
										//header('location:index.php?option=component&kind=tour&method=add_tour&process=select_country&type=tour&t_id='.$insert);
							}elseif($type == 'tour_country' && isset($_GET['process']) == 'select_country' && isset($_GET['t_id']) != null && isset($_GET['ins']) != '')
							{
								//echo 'run tour country  update code in';
								 $id = $_POST['tc_id'];
									$update_tour_country = Form_Update($type,$id,$seo_table);		
									//echo 'update is:'.$update_tour_country;							
									if($update_tour_country == '1')
									{
												$t_id = $_GET['t_id'];
													$kind = $_GET['kind'];
													$ty = $_GET['type'];
													$process = $_GET['process'];
												$ins = '2';  // for update
											 header('location:index.php?option=component&kind=tour&method=tour&process=view&type=tour&insert=2&ins=2');
									}	
							}elseif($type == 'tour_category' && $_GET['process'] == 'select_category' && isset($_GET['t_id']) != null && $_GET['ins'] == '')
							{
								
										//echo 'run tour category insert code';		
									$id = $_GET['t_id'];
										$check = $db->get_var("SELECT COUNT(*) FROM tour_category WHERE t_id = '$id' ");
										//echo $check;
										if($check == '1')
										{
														 $id = $_POST['tcat_id'];
															$update_tour_country = Form_Update($type,$id,$seo_table);		
															//echo 'update is:'.$update_tour_country;							
															if($update_tour_country == '1')
															{
																		$t_id = $_GET['t_id'];
																			$kind = $_GET['kind'];
																			$ty = $_GET['type'];
																			$process = $_GET['process'];
																		$ins = '2';  // for update
																	 header('location:index.php?option=component&kind=tour&method=tour&process=view&type=tour&insert=2&ins=2');
															}	
										
										}	else{											
										
									$insert_tour1 = Form_insert($type,$seo_table,$_POST);
									if($insert_tour1)
									{
													header('location:index.php?option=component&kind=tour&method=tour&process=view&type=tour&insert=1&ins=1');	
													
										}			
									}			
										//header('location:index.php?option=component&kind=tour&method=add_tour&process=select_country&type=tour&t_id='.$insert);
							}elseif($type == 'tour_category' && $_GET['process'] == 'select_category' && isset($_GET['t_id']) != null && isset($_GET['ins']) != '')
							{
								//echo 'run tour category  update code in';
									 $id = $_POST['tcat_id'];
									$update_tour_country = Form_Update($type,$id,$seo_table);		
															
									if($update_tour_country == '1')
									{
												$ins = '2';  // for update
											 header('location:index.php?option=component&kind=tour&method=tour&process=view&type=tour&insert=2&ins=2');
									}	
							}elseif($type == 'tour_destination' && $_GET['process'] == 'select_destination' && isset($_GET['t_id']) != null && $_GET['ins'] == '')
							{
								
										//echo 'run tour destination insert code';	
									$id = $_GET['t_id'];
										$check = $db->get_var("SELECT COUNT(*) FROM tour_destination WHERE t_id = '$id' ");
										//echo $check;
										if($check == '1')
										{
														 $id = $_POST['td_id'];
															$update_tour_country = Form_Update($type,$id,$seo_table);		
															//echo 'update is:'.$update_tour_country;							
															if($update_tour_country == '1')
															{
																		$t_id = $_GET['t_id'];
																			$kind = $_GET['kind'];
																			$ty = $_GET['type'];
																			$process = $_GET['process'];
																		$ins = '2';  // for update
																	 header('location:index.php?option=component&kind=tour&method=tour&process=view&type=tour&insert=2&ins=2');
															}	
										
										}else{											
											
									$insert_tour1 = Form_insert($type,$seo_table,$_POST);
									if($insert_tour1)
									{
													header('location:index.php?option=component&kind=tour&method=tour&process=view&type=tour&insert=1&ins=1');
										}						
									}	
							}
							elseif($type == 'tour_destination' && $_GET['process'] == 'select_destination' && isset($_GET['t_id']) != null && isset($_GET['ins']) != '')
							{
								//echo 'run tour destination  update code in';
									 $id = $_POST['td_id'];
									$update_tour_country = Form_Update($type,$id,$seo_table);		
									//echo 'update is:'.$update_tour_country;							
									if($update_tour_country == '1')
									{
													$ins = '2';  // for update
											 header('location:index.php?option=component&kind=tour&method=tour&process=view&type=tour&insert=2&ins=2');
									}	
							}
							
							
							else{								
																
													$insert=Form_insert($type,$seo_table,$_POST);
													if($insert)
													{
														$kind = $_GET['kind'];
														$method = $_GET['method'];
														$ty = $_GET['type'];
														header('location:index.php?option=component&kind='.$kind.'&method='.$method.'&process=view&type='.$ty.'&insert=3');	
													}
								}
					
					
					
					//echo '$insert is:'.$insert;
					}
}



if(isset($_POST['close']))
{
					 	//$type = $_GET['table'];
					
						$kind = $_GET['kind'];
						$method = $_GET['method'];
						$ty = $_GET['type'];
						if($ty == 'tour')
						{
							header('location:index.php?option=component&kind='.$kind.'&method=tour&process=view&type='.$ty);
							
							}	elseif($ty == 'batch_table')
						{
							header('location:index.php?option=component&kind='.$kind.'&method=batch&process=view&type='.$ty);
							
							}else{
												
						header('location:index.php?option=component&kind='.$kind.'&method='.$method.'&process=view&type='.$ty);
					}
}


if(isset($_POST['submit']))
{

		if(isset($_POST['g_folder']))
		{
					$folder=mkdir($_SERVER["DOCUMENT_ROOT"].'/admin/component/photogallary/'.$_POST['g_folder'], 0755);
					$full=mkdir($_SERVER["DOCUMENT_ROOT"].'/admin/component/photogallary/'.$_POST['g_folder'].'/full',0755);
					$thum=mkdir($_SERVER["DOCUMENT_ROOT"].'/admin/component/photogallary/'.$_POST['g_folder'].'/thumbnail',0755);
		}

$type = $_POST['table'];
if(isset($_POST['id']))
{

/*
echo '<pre>';
print_r($_POST);	
echo '</pre>';	
	echo 'in if block';*/
				if($_POST['seo_table']!='')
			{
			$seo_table='seo_detail';
			}
			else
			{
			$seo_table=null;
			}


		$id =$_POST['id'];		
	
		//if($type !='gallery' || $type != 'tour_country' || $type != 'tour_category' || $type != 'tour_destination')
			
		
			$seo_table='seo_detail';
			
			if($type == 'tour' && isset($_GET['process']) == 'add' && isset($_GET['id']) != null)
			{
					$id1 = $_GET['t_id'];
				$update=Form_Update($type,$id1,$seo_table);
					if($update == '1')
					{
								//echo 'run tour update code';
								$ins = '2';  // for update
							 header('location:index.php?option=component&kind=tour&method=tour&process=add&type=tour&t_id='.$_GET['id'].'&insert=2&ins=2');
					}	
			}elseif($type == 'batch_table' && isset($_GET['process']) == 'edit' && isset($_GET['id']) != null)
			{
				
//echo 'in not gallery';
//echo $update;
	$id =$_POST['id'];
$type = $_GET['type'];
$update1 =Form_Update($type,$id,$seo_table);
//echo $update1;
				
				if($update1 == '1')
				{
									$kind = $_GET['kind'];
									$method = $_GET['method'];
									$ty = $_GET['type'];
								 header('location:index.php?option=component&kind='.$kind.'&method='.$method.'&process=edit&type='.$ty.'&insert=2&id='.$id);	
					
				}
			//echo $update;
			}elseif($type !='gallery')
			{
				
//echo 'in not gallery';
//echo $update;
	$id =$_POST['id'];
$type = $_GET['type'];
$update1 =Form_Update($type,$id,$seo_table);
//echo $update1;
				
				if($update1 == '1')
				{
									$kind = $_GET['kind'];
									$method = $_GET['method'];
									$ty = $_GET['type'];
								 header('location:index.php?option=component&kind='.$kind.'&method='.$method.'&process=add&type='.$ty.'&insert=2&t_id='.$id);	
					
				}
			//echo $update;
			}
			/*elseif($type == 'tour' && isset($_GET['process']) == 'add' && isset($_GET['id']) != null)
			{
					if($update == '1')
					{
								echo 'run tour update code';
								$ins = '2';  // for update
							 header('location:index.php?option=component&kind=tour&method=tour&process=add&type=tour&t_id='.$_GET['id'].'&insert=2&ins=2');
					}	
			}*//*elseif($type == 'tour' && isset($_GET['process']) == 'add' && isset($_GET['id']) != null)
			{
					if($update == '1')
					{
								echo 'run tour update code';
								$ins = '2';  // for update
							 header('location:index.php?option=component&kind=tour&method=tour&process=add&type=tour&id='.$_GET['id'].'&insert=2&ins=2');
					}	
			}*/else{
			
			}
			
			
}else
{
/*echo '<pre>';
print_r($_POST);	
echo '</pre>';	
	echo 'in else block';*/
				if($_POST['seo_table']!='')
				{
				$seo_table='seo_detail';
				}
				else
				{ 
				$seo_table=null;
				}
				
			
						$type = $_POST['table'];
						if(isset($_GET['type']) == 'batch_table' && $_GET['insert'] == '33' && $_GET['b_id'] != '' && $_GET['ins'] == '')
						{
								
									//echo 'run select instructor insert code';
									$insert_instructor = Form_insert($type,$seo_table,$_POST);
									if($insert_instructor)
									{
									$kind = $_GET['kind'];
													$method = $_GET['method'];
													$ty = $_GET['type'];
													$process = $_GET['process'];
													$ins = '1';  // for insert
													$bid = $_GET['b_id'];
													header('location:index.php?option=component&kind='.$kind.'&method='.$method.'&process='.$process.'&type='.$ty.'&b_id='.$bid.'&insert=33&ins='.$ins);	
													//select instructor header code	 
											}		
							
						}elseif(isset($_GET['type']) == 'batch_table' && $_GET['insert'] == '33' && $_GET['b_id'] != '' && isset($_GET['ins']))
						{
			       		
									//echo 'run select instructor update code';
									$b_id= $_POST['b_id'];
									//print_r($_POST);
									$inst_id= $_POST['instructer_id'];
									$userid = $_POST['userid'];
									$inst_idd='';
									if($inst_id!='')
									{
									foreach($inst_id as $instruct_id)
									{
									
									$inst_idd.=$instruct_id.',';
									} }
									
									$batch_instructer= $db->get_row("SELECT * FROM batch_instructer WHERE b_id='$b_id'");
									if($batch_instructer->instructer_id==$inst_idd)
									{
									//echo 'value equal';
									}
									else
									{
									
									$original_value= $batch_instructer->instructer_id;
									$date=date('Y-m-d H:i:s');
									
									$admin_count= $db->get_row("SELECT * FROM admin_change WHERE (type='batch_instructer' AND type_id='$batch_instructer->bi_id') AND(field_change='instructer_id') ORDER BY ac_id DESC");
									if($admin_count)
									{
									$change_count=$admin_count->change_count + 1;
									}
									else
									{
									$change_count='1';
									}
									$insert_admin= $db->query("INSERT INTO admin_change VALUES('','batch_instructer','$batch_instructer->bi_id','instructer_id','$original_value','$inst_idd','$date','$userid','$change_count')");
									}
									$update_inst = $db->query("UPDATE batch_instructer SET instructer_id='$inst_idd' WHERE b_id='$b_id'");
									if($update_inst)
									{
											$kind = $_GET['kind'];
													$method = $_GET['method'];
													$ty = $_GET['type'];
													$process = $_GET['process'];
													$b_id= $_POST['b_id'];
													$ins = '2';  // for insert
													header('location:index.php?option=component&kind='.$kind.'&method='.$method.'&process='.$process.'&type='.$ty.'&b_id='.$b_id.'&insert=33&ins='.$ins);	
										}
							
						}elseif($_GET['process'] == 'pre_camp_value' && $_GET['insert'] == '44' && $_GET['b_id'] != '' && $_GET['ins'] == '')
						{
									//echo 'in else pre camp value update code';		
									//echo 'run pre camp value insert code';
									$insert_camp = Form_insert($type,$seo_table,$_POST);
									if($insert_camp)
									{
									$kind = $_GET['kind'];
													$method = $_GET['method'];
													$ty = $_GET['type'];
													$process = $_GET['process'];
													$ins = '1';  // for insert
													$bid = $_GET['b_id'];
													header('location:index.php?option=component&kind='.$kind.'&method='.$method.'&process='.$process.'&type='.$ty.'&b_id='.$bid.'&insert=44&ins='.$ins);	
													//select instructor header code	 
											}	
							
							
							}elseif($_GET['process'] == 'pre_camp_value' && isset($_GET['insert']) == '44' && isset($_GET['b_id']) != '' && isset($_GET['ins']) != '')
							{
							
										//echo 'run pre camp value update code';
										$b_id= $_GET['b_id'];
										$c = count($_POST['pc_id']);
										//echo 'count is'.$c;
										if($c > 1)
										{
											 $pre_camp_id = current($_POST['pc_id']);
											}else{
										$pre_camp_id = current($_POST['pc_id']);
									}
										
										//echo 'pre campid'.$pre_camp_id ;
										$userid= $_POST['userid'];
										$date11 = $_POST['date_pre'];
										$time= $_POST['time_pre'];
										
										//echo 'post date is:'.$date;
										//echo 'date is:';
										$date = date('Y-m-d',strtotime($date11));
										//echo 'post new date is:'.$dateasd;
											
										$pre_camp= $db->get_row("SELECT * FROM pre_camp_value WHERE batch_id='$b_id'");
										if($pre_camp->pc_id != $pre_camp_id)
										{
										
										
										
										$original_value= $pre_camp->pc_id;
										$date_change=date('Y-m-d H:i:s');
										
										$admin_count= $db->get_row("SELECT * FROM admin_change WHERE (type='pre_camp_value' AND type_id='$pre_camp->pcv_id') AND(field_change='pc_id') ORDER BY ac_id DESC");
										if($admin_count)
										{
										$change_count=$admin_count->change_count + 1;
										}
										else
										{
										$change_count='1';
										}
										$insert_admin= $db->query("INSERT INTO admin_change VALUES('','pre_camp_value','$pre_camp->pcv_id','pc_id','$original_value','$pre_camp_id','$date_change','$userid','$change_count')");
										
										
										}
										
										if($pre_camp->date_pre != $date)
										{
										
										
										
										$original_value= $pre_camp->date_pre;
										$date_change=date('Y-m-d H:i:s');
										
										$admin_count= $db->get_row("SELECT * FROM admin_change WHERE (type='pre_camp_value' AND type_id='$pre_camp->pcv_id') AND(field_change='date_pre') ORDER BY ac_id DESC");
										if($admin_count)
										{
										$change_count=$admin_count->change_count + 1;
										}
										else
										{
										$change_count='1';
										}
										$insert_admin= $db->query("INSERT INTO admin_change VALUES('','pre_camp_value','$pre_camp->pcv_id','date_pre','$original_value','$date','$date_change','$userid','$change_count')");
										
										
										
										}
										
										if($pre_camp->time_pre!=$time)
										{
										
										
										
										
										
										$original_value= $pre_camp->time_pre;
										$date_change=date('Y-m-d H:i:s');
										
										$admin_count= $db->get_row("SELECT * FROM admin_change WHERE (type='pre_camp_value' AND type_id='$pre_camp->pcv_id') AND(field_change='time_pre') ORDER BY ac_id DESC");
										if($admin_count)
										{
										$change_count=$admin_count->change_count + 1;
										}
										else
										{
										$change_count='1';
										}
										$insert_admin= $db->query("INSERT INTO admin_change VALUES('','pre_camp_value','$pre_camp->pcv_id','time_pre','$original_value','$time','$date_change','$userid','$change_count')");
										
										}
										
										
										$update_precamp = $db->query("UPDATE pre_camp_value SET pc_id ='$pre_camp_id',date_pre='$date',time_pre='$time' WHERE batch_id='$b_id'");
									if($update_precamp)
									{
													$kind = $_GET['kind'];
													$method = $_GET['method'];
													$ty = $_GET['type'];
													$process = $_GET['process'];
													$ins = '2';  // for insert
													$bid = $_GET['b_id'];
													header('location:index.php?option=component&kind='.$kind.'&method='.$method.'&process='.$process.'&type='.$ty.'&b_id='.$bid.'&insert=44&ins='.$ins);	
													 
											}	
							
							
							}	elseif($type == 'tour' && isset($_GET['process']) == 'add' && $_GET['t_id'] == '' && $_GET['ins'] == '')
							{
								
										//echo 'run tour insert code';		
										$insert_tour = Form_insert($type,$seo_table,$_POST);
									if($insert_tour)
									{
													$kind = $_GET['kind'];
													$ty = $_GET['type'];
													$process = $_GET['process'];
													$ins = '1';  // for insert
													header('location:index.php?option=component&kind='.$kind.'&method=tour&process='.$process.'&type='.$ty.'&t_id='.$insert_tour.'&insert=1&ins='.$ins);	
													//select instructor header code	 
											}						
										//header('location:index.php?option=component&kind=tour&method=add_tour&process=select_country&type=tour&t_id='.$insert);
							}elseif($type == 'tour' && isset($_GET['process']) == 'add' && isset($_GET['t_id']) != null)
							{
								
									//echo 'run tour update code in';
									$type = $_GET['type'];
								 $id = $_GET['t_id'];
								 	$seo_table='seo_detail';								
									$update = Form_Update($type,$id,$seo_table);									
									if($update == '1')
									{
											
												$ins = '2';  // for update
											 header('location:index.php?option=component&kind=tour&method=tour&process=add&type=tour&t_id='.$_GET['t_id'].'&insert=2&ins=2');
									}	
							}	elseif($type == 'tour_country' && $_GET['process'] == 'select_country' && isset($_GET['t_id']) != null && $_GET['ins'] == '')
							{
								
										//echo 'run tour country insert code';	
										$id = $_GET['t_id'];
										$check = $db->get_var("SELECT COUNT(*) FROM tour_country WHERE t_id = '$id' ");
										//echo $check;
										if($check == '1')
										{
													 $id = $_POST['tc_id'];
														$update_tour_country = Form_Update($type,$id,$seo_table);		
														if($update_tour_country == '1')
														{
																	$t_id = $_GET['t_id'];
																		$kind = $_GET['kind'];
																		$ty = $_GET['type'];
																		$process = $_GET['process'];
																	$ins = '2';  // for update
																 header('location:index.php?option=component&kind='.$kind.'&method=add_tour&process='.$process.'&type='.$ty.'&t_id='.$t_id.'&insert=2&ins=2');
														}	
											
											}else{	
									$insert_tour1 = Form_insert($type,$seo_table,$_POST);
									if($insert_tour1)
									{
													$t_id = $_GET['t_id'];
													$kind = $_GET['kind'];
													$ty = $_GET['type'];
													$process = $_GET['process'];
													$ins = '1';  // for insert
													header('location:index.php?option=component&kind='.$kind.'&method=add_tour&process='.$process.'&type='.$ty.'&t_id='.$t_id.'&insert=11&ins='.$ins);	
													//select instructor header code	 
										}				
									}		
										//header('location:index.php?option=component&kind=tour&method=add_tour&process=select_country&type=tour&t_id='.$insert);
							}elseif($type == 'tour_country' && isset($_GET['process']) == 'select_country' && isset($_GET['t_id']) != null && isset($_GET['ins']) != '')
							{
								//echo 'run tour country  update code in';
  							 $id = $_POST['tc_id'];
									$update_tour_country = Form_Update($type,$id,$seo_table);		
									if($update_tour_country == '1')
									{
												$t_id = $_GET['t_id'];
													$kind = $_GET['kind'];
													$ty = $_GET['type'];
													$process = $_GET['process'];
												$ins = '2';  // for update
											 header('location:index.php?option=component&kind='.$kind.'&method=add_tour&process='.$process.'&type='.$ty.'&t_id='.$t_id.'&insert=2&ins=2');
									}	
							}	elseif($type == 'tour_category' && $_GET['process'] == 'select_category' && isset($_GET['t_id']) != null && $_GET['ins'] == '')
							{
								
										//echo 'run tour country insert code';		
									$id = $_GET['t_id'];
										$check = $db->get_var("SELECT COUNT(*) FROM tour_category WHERE t_id = '$id' ");
										//echo $check;
										if($check == '1')
										{
														 $id = $_POST['tcat_id'];
															$update_tour_country = Form_Update($type,$id,$seo_table);		
															//echo 'update is:'.$update_tour_country;							
															if($update_tour_country == '1')
															{
																		$t_id = $_GET['t_id'];
																			$kind = $_GET['kind'];
																			$ty = $_GET['type'];
																			$process = $_GET['process'];
																		$ins = '2';  // for update
																	 header('location:index.php?option=component&kind='.$kind.'&method=add_tour&process='.$process.'&type='.$ty.'&t_id='.$t_id.'&insert=22&ins=2');
															}	
										
										}	else{						
										
														$insert_tour1 = Form_insert($type,$seo_table,$_POST);
														if($insert_tour1)
														{
																		$t_id = $_GET['t_id'];
																		$kind = $_GET['kind'];
																		$ty = $_GET['type'];
																		$process = $_GET['process'];
																		$ins = '1';  // for insert
																		header('location:index.php?option=component&kind='.$kind.'&method=add_tour&process='.$process.'&type='.$ty.'&t_id='.$t_id.'&insert=22&ins='.$ins);	
																		//select instructor header code	 
															}		
										
									}				
										//header('location:index.php?option=component&kind=tour&method=add_tour&process=select_country&type=tour&t_id='.$insert);
							}elseif($type == 'tour_category' && $_GET['process'] == 'select_category' && isset($_GET['t_id']) != null && isset($_GET['ins']) != '')
							{
								//echo 'run tour country  update code in';
									 $id = $_POST['tcat_id'];
									$update_tour_country = Form_Update($type,$id,$seo_table);		
									//echo 'update is:'.$update_tour_country;							
									if($update_tour_country == '1')
									{
												$t_id = $_GET['t_id'];
													$kind = $_GET['kind'];
													$ty = $_GET['type'];
													$process = $_GET['process'];
												$ins = '2';  // for update
											 header('location:index.php?option=component&kind='.$kind.'&method=add_tour&process='.$process.'&type='.$ty.'&t_id='.$t_id.'&insert=22&ins=2');
									}	
							}	
							elseif($type == 'tour_destination' && $_GET['process'] == 'select_destination' && isset($_GET['t_id']) != null && $_GET['ins'] == '')
							{
								
									//echo 'run tour destination insert code';		
									$id1 = $_GET['t_id'];
										$check = $db->get_var("SELECT COUNT(*) FROM tour_destination WHERE t_id = '$id1' ");
										//echo $check;
										if($check == '1')
										{
														 $id = $_POST['td_id'];
														// echo $id.'=id';
															$update_tour_country = Form_Update($type,$id,$seo_table);		
															//echo 'update is:'.$update_tour_country;							
															if($update_tour_country == '1')
															{
																		//echo 'in if tag';
																		$t_id = $_GET['t_id'];
																			$kind = $_GET['kind'];
																			$ty = $_GET['type'];
																			$process = $_GET['process'];
																		$ins = '2';  // for update
																	 header('location:index.php?option=component&kind='.$kind.'&method=add_tour&process='.$process.'&type='.$ty.'&t_id='.$t_id.'&insert=33&ins=2');
															}	
										
										}else{										

														$insert_tour1 = Form_insert($type,$seo_table,$_POST);
														if($insert_tour1)
														{
																		$t_id = $_GET['t_id'];
																		$kind = $_GET['kind'];
																		$ty = $_GET['type'];
																		$process = $_GET['process'];
																		$ins = '1';  // for insert
																		header('location:index.php?option=component&kind='.$kind.'&method=add_tour&process='.$process.'&type='.$ty.'&t_id='.$t_id.'&insert=33&ins='.$ins);	
																		//select instructor header code	 
															}
									}			
													
										//header('location:index.php?option=component&kind=tour&method=add_tour&process=select_country&type=tour&t_id='.$insert);
							}
							elseif($type == 'tour_destination' && $_GET['process'] == 'select_destination' && isset($_GET['t_id']) != null && isset($_GET['ins']) != '')
							{
								echo 'run tour destination  update code in';
									 $id = $_POST['td_id'];
									$update_tour_country = Form_Update($type,$id,$seo_table);		
									//echo 'update is:'.$update_tour_country;							
									if($update_tour_country == '1')
									{
												$t_id = $_GET['t_id'];
													$kind = $_GET['kind'];
													$ty = $_GET['type'];
													$process = $_GET['process'];
												$ins = '2';  // for update
											 header('location:index.php?option=component&kind='.$kind.'&method=add_tour&process='.$process.'&type='.$ty.'&t_id='.$t_id.'&insert=33&ins=2');
									}	
							}		
								elseif(isset($_GET['b_id']))
							{
							
							//echo 'run pre camp value update code 12334';
							$id = $_GET['b_id'];	
								$update=Form_Update($type,$id,$seo_table);
										if($update == '1')
										{
												$kind = $_GET['kind'];
												$method = $_GET['method'];
												$ty = $_GET['type'];
												if($type =='batch_table')
												{
											 					header('location:index.php?option=component&kind='.$kind.'&method='.$method.'&process=add&type='.$ty.'&insert=2&b_id='.$id);
												}
											
										}
							
						}else{
							
								//echo 'run tour aassaaaa code in';
							$insert=Form_insert($type,$seo_table,$_POST);
							}


if($insert)
{
	
//echo '$insert is:'.$insert;
			if($type != 'batch_table' || $type != 'tour')
			{
							$kind = $_GET['kind'];
							$method = $_GET['method'];
							$ty = $_GET['type'];
						 header('location:index.php?option=component&kind='.$kind.'&method='.$method.'&process=add&type='.$ty.'&insert=1&id='.$insert);	

			}
			/*elseif($type == 'batch_table' && isset($_GET['insert']) == '33' && isset($_GET['b_id']) != '' && isset($_GET['ins']) == '')
			{
				
				   	$kind = $_GET['kind'];
							$method = $_GET['method'];
							$ty = $_GET['type'];
							$process = $_GET['process'];
							$ins = '1';  // for insert
							header('location:index.php?option=component&kind='.$kind.'&method='.$method.'&process='.$process.'&type='.$ty.'&insert=33&ins='.$insert);	
							//select instructor header code	 
							
				}*/
				if($type =='batch_table' && $id == '' && $_GET['process'] == 'add')
			{
				 header('location:index.php?option=component&kind=batch&method=batch&process=add&type=batch_table&insert=1&b_id='.$insert);
		
			}
					
}
				
			
//}

//echo '$insert is:'.$insert;
}

if(isset($_POST['id']))
{
$id =$_POST['id']; } else { $id='';}

if($type=='gallery')
{
$pageURL =$_SERVER["REQUEST_URI"];
$page=explode('step=1',$pageURL);
header('location:'.$page[0].'step=2&g_id='.$insert);
}
//$type1 = $_GET['type'];
//$id1 = $_GET['id'];
//$vgid = $_GET['vg_id'];
$vgid = $insert;
//echo 'vgid is:'.$insert;

//$step = $_GET['step'];
if($_GET['kind'] == 'videogallery')
{
				if($step == '2' )
				{//echo 'step2 complete';
							$type1 = $_GET['type'];
							$id1 = $_GET['id'];
							$step = $_GET['step'];
							header('location:index.php?option=component&kind=videogallery&method=gallery&process=add&type='.$type1.'&id='.$id1.'&step=3&vg_id='.$insert);
				}
				elseif($step == '3')
				{//echo 'step3 complete';
				//header('location:index.php?option=component&kind=videogallery&method=gallery&process=add&type='.$type1.'&id='.$id1.'&step=3&vg_id='.$insert);
				}
}

/*if($type == 'tour' && isset($_GET['process']) == 'add')
{
	header('location:index.php?option=component&kind=tour&method=add_tour&process=select_country&type=tour&t_id='.$insert);
}

if($type == 'tour' && isset($_GET['process']) == 'add' && isset($_GET['id']) != null)
{

	header('location:index.php?option=component&kind=tour&method=add_tour&process=select_country&type=tour&id='.$_GET['id']);
}*/
if(isset($_POST['t_id']))
{
$t_id= $_POST['t_id'];
}
/*if($type == 'tour_country' && isset($_GET['process']) == 'add')
{
	header('location:index.php?option=component&kind=tour&method=add_tour&process=select_category&type=tour&t_id='.$t_id);
}

if($type == 'tour_country' && isset($_GET['process']) == 'add' && isset($_GET['id']) != null)
{
		/*$update=Form_Updatation($type,$id,$seo_table);
	echo $update;
header('location:index.php?option=component&kind=tour&method=add_tour&process=select_category&type=tour&id='.$_GET['id']);
}*/

/*if($type == 'tour_category' && isset($_GET['process']) == 'add')
{
	header('location:index.php?option=component&kind=tour&method=add_tour&process=select_destination&type=tour&t_id='.$t_id);
}

if($type == 'tour_category' && isset($_GET['process']) == 'add' && isset($_GET['id']) != null)
{
	header('location:index.php?option=component&kind=tour&method=add_tour&process=select_destination&type=tour&id='.$_GET['id']);
}*/

/*if($type == 'tour_destination' && isset($_GET['process']) == 'add')
{
	header('location:index.php?option=component&kind=tour&method=add_tour&process=schedule_type&type=tour&t_id='.$t_id);
}



if($type == 'tour_destination' && isset($_GET['process']) == 'add' && isset($_GET['id']) != null)
{
	header('location:index.php?option=component&kind=tour&method=add_tour&process=schedule_type&type=tour&id='.$_GET['id']);
}*/

}

if(isset($_POST['schedule_skip']))
{
	header('location:index.php?option=component&kind=tour&method=tour&process=view&type=tour');
}

/*if(isset($_POST['update_tour_countrty']))
{
	
	$type = $_POST['table'];
	$seo_table = $_POST['seo_table'];
	$id = $_POST['id'];
		$update=Form_Updatation($type,$id,$seo_table);
	echo $update;
	//header('location:index.php?option=component&kind=tour&method=tour&process=view&type=tour');
}*/

if(isset($_POST['submit_batchfee']))
{
$b_id= $_POST['b_id'];

if(isset($_GET['bfid']) == '')
{
						foreach($_POST as $key=>$value)
						{
						//echo 'key '.$key.'<br />';
						$currency= $db->get_results("SELECT * FROM currency");
						foreach($currency as $cu)
						{
						$batch_charges= $db->get_results("SELECT * FROM batch_charges_type");
						foreach($batch_charges as $fee)
						{
						//print_r($value[2]);
						//echo'bc_id'.$fee->bc_id.'cr_id'.$cu->cr_id. 'value '.$value[$cu->cr_id][$fee->bc_id].'<br />';
						$values=$value[$cu->cr_id][$fee->bc_id];
						if($values!='')
						{
									$batch_fee= $db->query("INSERT INTO batch_fee VALUES('','$fee->bc_id','$values','$cu->cr_id','$b_id')");
									
						}
						//header('location:index.php?option=component&kind=batch&method=add_batch&process=discount_value&type=batch_table&insert=1&b_id='.$b_id.'&bfid='.$bf_id);
						}
						
						}
						break 1;
						}
						
						if($batch_fee)
						{
									$bf_id = '1';
									header('location:index.php?option=component&kind=batch&method=add_batch&process=batch_fee&type=batch_table&insert=11&b_id='.$b_id.'&bfid=1');
						}

}else{

			//echo 'form update';
			$b_id= $_POST['b_id'];
			$userid= $_POST['userid'];
			//print_r($_POST);
			foreach($_POST as $key=>$value)
			{
							//echo 'key '.$key.'<br />';
							$currency= $db->get_results("SELECT * FROM currency");
							foreach($currency as $cu)
							{
											$batch_charges= $db->get_results("SELECT * FROM batch_charges_type");
											foreach($batch_charges as $fee)
											{
										
											//print_r($value);
											//echo'bc_id : '.$fee->bc_id.'cr_id : '.$cu->cr_id. 'value :  '.$value[$cu->cr_id][$fee->bc_id].'<br />';
											
											$values=$value[$cu->cr_id][$fee->bc_id];
											//if($values!='')
											//{
											$batch_fees= $db->get_row("SELECT * FROM batch_fee WHERE (b_id='$b_id' AND bc_id='$fee->bc_id') AND (bf_cr_id='$cu->cr_id')");
														if($batch_fees)
														{
														
																	//echo'value'.$batch_fees->bf_value.'<br />';
																	$date=date('Y-m-d H:i:s');
																	if($batch_fees->bf_value==$values)
																	{
																				//echo 'value '.$values.'<br />';
																	}
																	else
																	{
																				//echo 'value'.$batch_fees->bf_value.'new value'.$values.'<br />';
																				$original_value=$batch_fees->bf_value;
																				
																				$admin_count= $db->get_row("SELECT * FROM admin_change WHERE (type='batch_fee' AND type_id='$batch_fees->bf_id') AND(field_change='bf_value') ORDER BY ac_id DESC");
																				if($admin_count)
																				{
																								$change_count=$admin_count->change_count + 1;
																				}
																				else
																				{
																									$change_count='1';
																				}
																				$insert_admin= $db->query("INSERT INTO admin_change VALUES('','batch_fee','$batch_fees->bf_id','bf_value','$original_value','$values','$date','$userid','$change_count')");
																				
																	}
																	
																	$update= $db->query("UPDATE batch_fee SET bf_value='$values' WHERE( b_id='$b_id' AND bc_id='$fee->bc_id') AND (bf_cr_id='$cu->cr_id')");
														}
														else
														{
														
														}
											
										
											}
							}
							break 1;
			}

			if($update)
			{
			$bf_id = '2';
			header('location:index.php?option=component&kind=batch&method=add_batch&process=batch_fee&type=batch_table&insert=2&b_id='.$b_id.'&bfid=2');
			}
	
	
	}  //else close

}



if(isset($_POST['submit_batchfee_skip']))
{
$b_id= $_POST['b_id'];
//header('location:add.php?type=discount_value&tmpl=default&b_id='.$b_id);
header('location:index.php?option=component&kind=batch&method=add_batch&process=discount_value&type=batch_table&insert=33&b_id='.$b_id);
}

if(isset($_POST['submit_discount_skip']))
{
$b_id= $_POST['b_id'];
//header('location:add.php?type=schedule_type&tmpl=default&b_id='.$b_id);
header('location:index.php?option=component&kind=batch&method=add_batch&process=select_instructer&type=batch_table&insert=44&b_id='.$b_id);
}
if(isset($_POST['next_precamp_value']))
{
header('location:index.php?option=component&kind=batch&method=batch&process=view&type=batch_table&insert=55');
//header('location:index.php?option=component&kind=batch&method=batch&process=view&type=batch_table');
}

if(isset($_POST['submit_discount']))
{
				$b_id= $_POST['b_id'];
				if(isset($_GET['bdid']) == '')
				{
								//print_r($_POST);
								foreach($_POST as $key=>$value)
								{
												//echo 'key '.$key.'<br />';
												$discount_type= $db->get_results("SELECT * FROM discount_type");
												foreach($discount_type as $offer)
												{
																//print_r($value[2]);
																//echo'dt_id'.$offer->dt_id. 'value '.$value[$offer->dt_id].'<br />';
																$values=$value[$offer->dt_id];
																if($values!='')
																{
																$batch_fee= $db->query("INSERT INTO discount_value VALUES('','$offer->dt_id','$values','$b_id')");
																}
																//header('location:index.php?option=component&kind=batch&method=add_batch&process=select_instructer&type=batch_table&tmpl=default&b_id='.$b_id);
												}
												break 1;
								}
								
								if($batch_fee)
								{
											$bf_id = '1';
											header('location:index.php?option=component&kind=batch&method=add_batch&process=discount_value&type=batch_table&insert=22&b_id='.$b_id.'&bdid=1');
								}
			}else{
				
						$b_id= $_POST['b_id'];
						//print_r($_POST);
						$userid= $_POST['userid'];
						foreach($_POST as $key=>$value)
						{
										//echo 'key '.$key.'<br />';
										$discount_type= $db->get_results("SELECT * FROM discount_type");
										foreach($discount_type as $offer)
										{
													//print_r($value[2]);
													//echo'dt_id'.$offer->dt_id. 'value '.$value[$offer->dt_id].'<br />';
													$values=$value[$offer->dt_id];
													
													$discount_value= $db->get_row("SELECT * FROM discount_value WHERE (dv_bid='$b_id' AND dt_id='$offer->dt_id' )");
													if($discount_value)
													{
													
																	if($discount_value->dv_value==$values)
																	{
																	
																	}
																	else
																	{
																					//echo'value'.$discount_value->dv_value.'new value'.$values.'<br />';
																					$original_value= $discount_value->dv_value;
																					$date=date('Y-m-d H:i:s');
																					
																					$admin_count= $db->get_row("SELECT * FROM admin_change WHERE (type='discount_value' AND type_id='$discount_value->dv_id') AND(field_change='dv_value') ORDER BY ac_id DESC");
																					if($admin_count)
																					{
																									$change_count=$admin_count->change_count + 1;
																					}
																					else
																					{
																										$change_count='1';
																					}
																					$insert_admin= $db->query("INSERT INTO admin_change VALUES('','discount_value','$discount_value->dv_id','dv_value','$original_value','$values','$date','$userid','$change_count')");
																					
																	}
																	
													$update_discount= $db->query("UPDATE discount_value SET dv_value='$values' WHERE (dv_bid='$b_id' AND dt_id='$offer->dt_id' )");
													}
													else
													{
													$batch_fee= $db->query("INSERT INTO discount_value VALUES('','$offer->dt_id','$values','$b_id')");
													
													}
													
										}
										break 1;
						}
				
				if($update_discount)
				{
						$bd_id = '2';
						header('location:index.php?option=component&kind=batch&method=add_batch&process=discount_value&type=batch_table&insert=22&b_id='.$b_id.'&bdid=2');
				}
				
				}  //else close
}


if(isset($_POST['next']))
{
$b_id=$_POST['b_id'];
//header('location:add.php?type=select_instructer&tmpl=default&b_id='.$b_id);
header('location:index.php?option=component&kind=batch&method=add_batch&process=select_instructer&type=batch_table&tmpl=default&b_id='.$b_id);
}
if(isset($_POST['back']))
{
$b_id=$_POST['b_id'];
header('location:details.php?type=batch_table&tmpl=edit&id='.$b_id);
}
if(isset($_POST['next_precamp']))
{
$b_id=$_POST['b_id'];
header('location:index.php?option=component&kind=batch&method=add_batch&process=pre_camp_value&type=batch_table&insert=44&b_id='.$b_id);
//header('location:add.php?type=pre_camp_value&tmpl=default&b_id='.$b_id);
}
?>
<?php
if(isset($_POST['submit_schedule']))
{
//print_r($_POST);
$schedule= $db->get_results("SELECT * FROM schedule_type");
$b_id= $_POST['t_id'];
$bath_schedule= $db->get_row("SELECT * FROM tour_schedule_value WHERE t_id='$b_id' ORDER BY group_id DESC LIMIT 1");
if($bath_schedule)
{
$group_id= $bath_schedule->group_id + 1;
}
else
{
//echo 'group id'.$bath_schedule->group_id.'<br />';
$group_id='1';
}
foreach($schedule as $schedules)
{
foreach($_POST as $key=>$value)
{
//echo 'key'. $key.'<br />';
//print_r($value);
//echo 'value'.$value[2];
if(!empty($value[$schedules->st_id]))
{
$values=$value[$schedules->st_id];
//echo $value[$schedules->st_id].'<br >';
if($values!='' && $values!='b' && $values!='u')
{
//echo 'scid :'.$schedules->st_id.'<br />';
//echo 'values'.$values.'<br />';
//echo $schedules->st_ty. $value[$schedules->st_id];
//echo $key[$schedules->st_id].'<br />';
//echo 'type'.$schedules->st_ty.'value'.$value[$schedules->st_id];
//echo'title'. $value['Title'][1];

$insert_schedule = $db->query("INSERT INTO tour_schedule_value VALUES('','$schedules->st_id','$group_id','$b_id','$values')");
}
}
//break ;
}
//break 1;
}

if($insert_schedule )
{			
			$t_id = $_GET['t_id'];
			header('location:index.php?option=component&kind=tour&method=add_tour&process=schedule_type&type=tour&insert=44&t_id='.$t_id.'&ins=1');	
	
	}
}
?>
<?php
if(isset($_POST['upload_zip']))
{
include_once('class.upload.php');
include_once(config.'photogallary/config/config.php');
ini_set ( "memory_limit", "128M");
//if(isset($_POST['Submit']))
//{
//print_r($_FILES['zip_upload']);
//$zipObj = new ZipArchive;
$g_id= $_POST['g_id'];
$type= $_POST['type'];
$type_id= $_POST['type_id'];
$image_link= $db->query("INSERT INTO image_gallery_link VALUES('','$g_id','$type','$type_id')");
$gallery= $db->get_row("SELECT * FROM gallery WHERE g_id='$g_id'");
$zip = new ZipArchive;
$res = $zip->open($_FILES['zip_upload']['tmp_name']);
if ($res === TRUE) {
   // echo 'ok';
    $zip->extractTo(gallery.'photogallary/'.$gallery->g_folder);
	$files = glob(gallery."photogallary/".$gallery->g_folder."/*.*");
	//print_r($files);
		for ($i=0; $i<count($files); $i++) 
{
print_r($files[$i]);
$num = $files[$i];
$image_name=explode('/home/beyondwi/public_html/admin/component/photogallary/'.$gallery->g_folder.'/',$num);

$folder='old';
 $foo = new Upload($num); 
 if ($foo->uploaded) {   
 
 
 $insert= $db->query("INSERT INTO images VALUES('','$g_id','$image_name[1]','')");
$insert_id= $db->insert_id;
 // save uploaded image with no changes
 // save uploaded image with a new name 
 //$foo->file_new_name_body = 'foo';   
 //$foo->Process('./image/thumbnail');   
 // save uploaded image with a new name,  
 // resized to 100px wide 
 //$foo->file_new_name_body = 'image_full'; 
  //$a = mkdir(mainsite."/image/full/$section->seo_title/$seo_title", 0755);
  $foo->image_convert = 'jpg';   
$foo->image_resize          = true;
$foo->image_ratio_crop      = true;
$foo->image_y               = $full_height; //hieght
$foo->image_x               = $full_width;	//widthphoto
 $foo->file_new_name_body   = $insert_id;
 if($logo_upload == 'yes'){
$foo->image_watermark =logo_path.$logo_path;
$foo->image_watermark_no_zoom_out = true;
$foo->image_watermark_position = $watermark_position;
}
 $foo->Process(gallery.'photogallary/'.$gallery->g_folder.'/full');  
 if ($foo->processed) {   
// echo 'image renamed, resized x=600      
 //and converted to GIF<br />';    
 }
 //$foo->file_new_name_body = $insert_id; 
 //$a = mkdir(mainsite."/image/thumbnail/".$section->seo_title."/".$seo_title, 0755);
$foo->image_convert = 'jpg';   
$foo->image_resize          = true;
$foo->image_ratio_crop      = true;
$foo->image_y               = $thumb_height; //hieght
$foo->image_x               = $thumb_width;	//width
 $foo->file_new_name_body   = $insert_id;
  if($logo_upload == 'yes'){
$foo->image_watermark =logo_path.$logo_path;
$foo->image_watermark_no_zoom_out = true;
$foo->image_watermark_position = $watermark_position;
}
 $foo->Process(gallery.'photogallary/'.$gallery->g_folder.'/thumbnail');  
 if ($foo->processed) {   
 //echo 'image renamed, resized x=200      
 //and converted to GIF';   
 $foo->Clean(); 
 } else 
 {   //  echo 'error : ' . $foo->error; 
 } 
 }
}
$zip->close();
}
$pageURL =$_SERVER["REQUEST_URI"];
$page=explode('step=2',$pageURL);
header('location:'.$page[0].'step=3&g_id='.$g_id);
}
?>
<?php
if(isset($_POST['exit_gallary']))
{
$type= $_POST['type'];
$type_id= $_POST['type_id'];
header('location:./details.php?type='.$type.'&tmpl=default&id='.$type_id);
}
?>
<?php
if(isset($_POST['update_image']))
{

foreach($_POST as $key=>$value)
{
//print_r($key);
//print_r($value);
$ig_id= $_POST['ig_id'];
$type= $_POST['type'];
$type_id= $_POST['type_id'];
if(is_array($value))
{
foreach($value as $id=>$title)
{
//echo'id :'.$id.'title :'.$title;
if($title=='show' || $title=='hide')
{
$update= $db->query("UPDATE images SET im_status='$title' WHERE im_id='$id'");
if($title=='hide')
{
$hide_image= $db->get_row("SELECT * FROM hide_image WHERE im_id='$id' AND ig_id='$ig_id'");
if($hide_image==FALSE)
{
$insert= $db->query("INSERT INTO hide_image VALUES('','$id','$ig_id','$title')");
}
}
}
else
{
$update= $db->query("UPDATE images SET im_title='$title' WHERE im_id='$id'");
}
}
}
}
//header('location:./details.php?type='.$type.'&tmpl=default&id='.$type_id);
header('location:./index.php?option=component&kind=batch&method=batch&process=details&type=batch_table&tmpl=custom&id='.$type_id);
//print_r($_SESSION);
}
?>
<?php
if(isset($_GET['img_id']) && isset($_GET['folder']))
{
$folder= $_GET['folder'];
$file=gallery.'photogallary/'.$folder.'/full/'.$_GET['img_id'].'.jpg';
$file_thumb=gallery.'photogallary/'.$folder.'/thumbnail/'.$_GET['img_id'].'.jpg';
//$file1=$_SERVER['DOCUMENT_ROOT'].'/gowild/admin/component/photogallary/'.$folder.'/thumbnail/'.$_GET['img_id'].'jpg';
$fh=fopen($file,'r');
$fh_thumb=fopen($file_thumb,'r');
if(@$fh && @$fh_thumb)
{
//$fh1=fopen($file1,'a');
$delete_image=(unlink($file));
$delete_image_thumb=(unlink($file_thumb));
if($delete_image && $delete_image_thumb)
{
$delete= $db->query("DELETE FROM images WHERE im_id='$_GET[img_id]'");
header('location:'.$_SERVER['HTTP_REFERER']);
}
}
}
?>
<?php
//this use only set image delete
if(isset($_GET['si_id']) && isset($_GET['imagefolder']))
{
$folder= $_GET['imagefolder'];
$file=set_image.'slideshow/'.$folder.'/'.$_GET['si_id'].'.jpg';
//$file1=$_SERVER['DOCUMENT_ROOT'].'/gowild/admin/component/photogallary/'.$folder.'/thumbnail/'.$_GET['img_id'].'jpg';
$fh=fopen($file,'r');
if(@$fh)
{
//$fh1=fopen($file1,'a');
$delete_image=(unlink($file));
if($delete_image)
{
$delete= $db->query("DELETE FROM set_image WHERE si_id='$_GET[si_id]'");
header('location:'.$_SERVER['HTTP_REFERER']);
}
}
else
{
$delete= $db->query("DELETE FROM set_image WHERE si_id='$_GET[si_id]'");
header('location:'.$_SERVER['HTTP_REFERER']);
}
}
?>
<?php
if(isset($_POST['submit_gallery_link']))
{
//print_r($_POST);
$select_gallery= $_POST['select_gallery'];
$type= $_POST['type'];
$type_id= $_POST['type_id'];
foreach($select_gallery as $gallery)
{
$insert= $db->query("INSERT INTO image_gallery_link VALUES('','$gallery','$type','$type_id')");
}
header('location:./details.php?type='.$type.'&tmpl=default&id='.$type_id);
//echo $_SESSION['header_location'];
//print_r($_SESSION);
}
?>
<?php
if(isset($_POST['upload_image']))
{ 

include_once('class.upload.php');
include_once(config.'photogallary/config/config.php');
ini_set ( "memory_limit", "128M");
//if(isset($_POST['Submit']))
//{
//print_r($_FILES['zip_upload']);
//$zipObj = new ZipArchive;
$type= $_POST['type'];
$type_id= $_POST['type_id'];


$img_name=$_FILES['image_upload']['name'];
 $foo = new Upload($_FILES['image_upload']['tmp_name']); 
 if ($foo->uploaded) {   
 //$songs_vote= $db->get_results("SELECT song_table .*, song_vote.* FROM song_table LEFT JOIN song_vote ON song_table.st_id = song_vote.st_id WHERE song_table.sc_id LIKE '%$ucat->sc_id%' ORDER BY song_vote.type DESC");
 $image_link= $db->get_row("SELECT image_gallery_link .*, gallery.* FROM image_gallery_link LEFT JOIN gallery ON image_gallery_link.g_id = gallery.g_id WHERE image_gallery_link.type='$type' AND image_gallery_link.type_id='$type_id'");
 //print_r($image_link);
 
 $insert= $db->query("INSERT INTO images VALUES('','$image_link->g_id','$img_name','')");
$insert_id= $db->insert_id;
 // save uploaded image with no changes
 // save uploaded image with a new name 
 //$foo->file_new_name_body = 'foo';   
 //$foo->Process('./image/thumbnail');   
 // save uploaded image with a new name,  
 // resized to 100px wide 
 //$foo->file_new_name_body = 'image_full'; 
  //$a = mkdir(mainsite."/image/full/$section->seo_title/$seo_title", 0755);
  $foo->image_convert = 'jpg';   
$foo->image_resize          = true;
$foo->image_ratio_crop      = true;
$foo->image_y               = $full_height; //hieght
$foo->image_x               = $full_width;	//width
 $foo->file_new_name_body   = $insert_id;
 if($logo_upload == 'yes'){
$foo->image_watermark =logo_path.$logo_path;
$foo->image_watermark_no_zoom_out = true;
$foo->image_watermark_position = $watermark_position;
}
 $foo->Process(gallery.'photogallary/'.$image_link->g_folder.'/full');  
 if ($foo->processed) {   
// echo 'image renamed, resized x=600      
 //and converted to GIF<br />';    
 }
 //$foo->file_new_name_body = $insert_id; 
 //$a = mkdir(mainsite."/image/thumbnail/".$section->seo_title."/".$seo_title, 0755);
$foo->image_convert = 'jpg';   
$foo->image_resize          = true;
$foo->image_ratio_crop      = true;
$foo->image_y               = $thumb_height; //hieght
$foo->image_x               = $thumb_width;	//width
 $foo->file_new_name_body   = $insert_id;
  if($logo_upload == 'yes'){
$foo->image_watermark =logo_path.$logo_path;
$foo->image_watermark_no_zoom_out = true;
$foo->image_watermark_position = $watermark_position;
}
 $foo->Process(gallery.'photogallary/'.$image_link->g_folder.'/thumbnail');  
 if ($foo->processed) {   
 //echo 'image renamed, resized x=200      
 //and converted to GIF';   
 $foo->Clean(); 
 } else 
 {   //  echo 'error : ' . $foo->error; 
 } 
 }
}
?>
<?php

if(isset($_POST['sets']))
{
$title= $_POST['title'];
$status= $_POST['status'];
$height = $_POST['height'];
$width = $_POST['width'];
$copyright = $_POST['copyright'];

$insert= $db->query("INSERT INTO sets VALUES('','$title','$status','$height','$width','$copyright')");
if($insert)
{
header('location:index.php?option=component&kind=slideshow');
}
}

if(isset($_POST['update_sets']))
{
$title= $_POST['title'];
$status= $_POST['status'];
$height = $_POST['height'];
$width = $_POST['width'];
$copyright = $_POST['copyright'];
$id = $_GET['id'];

$update= $db->query("UPDATE sets SET set_title = '$title', set_status = '$status', set_height = '$height', set_width = '$width', set_copyright = '$copyright' WHERE set_id = '$id' ");
if($update)
{
header('location:index.php?option=component&kind=slideshow');
}
}


if(isset($_POST['add_set_image']))
{

$set_id= $_POST['set_id'];
$image_title= $_POST['image_title'];
$desc= $_POST['desc'];
$linkto= $_POST['linkto'];
$status= $_POST['status'];
$copyright_name = $_POST['copyright_name'];

include_once('class.upload.php');

//echo gallery;

$image_name= $_FILES['image_upload']['name'];
$insert= $db->query("INSERT INTO set_image VALUES('','$image_title','$desc','$linkto','$status','$image_name','$set_id','$copyright_name')");
$insert_id=$db->insert_id;
ini_set ( "memory_limit", "128M");


	//echo'md5 '.$userfolder;

 $foo = new Upload($_FILES['image_upload']['tmp_name']); 
 if ($foo->uploaded) {   
 // save uploaded image with no changes
 
   
 // save uploaded image with a new name 
 //$foo->file_new_name_body = 'foo';   
 //$foo->Process('./image/thumbnail');   
   
 // save uploaded image with a new name,  
 // resized to 100px wide 
 $foo->file_new_name_body = $insert_id; 
  //$a = mkdir(mainsite."/image/full/$section->seo_title/$seo_title", 0755);
 $foo->image_resize = true;   /*$foo->image_convert = 'jpg'; */  $foo->image_x = 1027;  $foo->image_y = 470; //$foo->image_ratio_y = true;  
//$foo->image_background_color = '#FF00FF';
//$foo->image_watermark       = $_SERVER['DOCUMENT_ROOT'].'/gowild/images/1banner_frame.jpg';
 $foo->Process(set_image.'/slideshow/images');  
 if ($foo->processed) {   
 echo 'image renamed, resized x=600      
 and converted to GIF<br />';    
 
 }

 

 
 
}
}

if(isset($_POST['update_set']))
{
$set_id= $_POST['set_id'];
foreach($_POST as $key=>$value)
{
print_r($key);
print_r($value);
if(is_array($value))
{
foreach($value as $id=>$title)
{
//echo 'id :'.$id.'title :'.$title.'key :'.$key.'<br />';
$update= $db->query("UPDATE set_image SET $key='$title' WHERE si_id='$id' AND set_id='$set_id'");
}
header('location:./index.php?option=component&kind=slideshow');
}
}
}
if(isset($_POST['set_exit']))
{
header('location:./index.php?option=component&kind=slideshow');
}
?>
<?php
if(isset($_GET['set_idUn']))
{
$update= $db->query("UPDATE sets SET set_status='unpublish' WHERE set_id='$_GET[set_idUn]'");
header('location:'.$_SERVER['HTTP_REFERER']);
}
?>
<?php
if(isset($_GET['set_idPub']))
{
$update= $db->query("UPDATE sets SET set_status='Publish' WHERE set_id='$_GET[set_idPub]'");
header('location:'.$_SERVER['HTTP_REFERER']);
}
?>
<?php
if(isset($_GET['image_name']) && isset($_GET['image_folder']))
{
$folder= $_GET['folder'];
$file=$_SERVER['DOCUMENT_ROOT'].'/images/items/'.$_GET['image_folder'].'/'.$_GET['image_name'].'.jpg';
//echo $file;
$fh=fopen($file,'r');
if(@$fh)
{
$delete_image=(unlink($file));
header('location:'.$_SERVER['HTTP_REFERER']);
}
else
{
$file_png=$_SERVER['DOCUMENT_ROOT'].'/images/items/'.$_GET['image_folder'].'/'.$_GET['image_name'].'.png';
//echo $file_png;
$fh_png=fopen($file_png,'r');
if(@$fh_png)
{
$delete_image=(unlink($file_png));
header('location:'.$_SERVER['HTTP_REFERER']);
}
}
}


include_once('tinymce.php');

?>
<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Bootstrap Admin</title>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Thoughtfulviewfinder Services" >

    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/theme.css">
    <link rel="stylesheet" href="css/font-awesome/css/font-awesome.css">
    
			<!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="../assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
			
	
	<link rel="stylesheet" href="css/colorbox.css" />
<link href="css/bootstrap-datetimepicker.min.css" type="text/css" rel="stylesheet" />
	
    <!-- Demo page code -->

    <style type="text/css">
        #line-chart {
            height:300px;
            width:800px;
            margin: 0px auto;
            margin-top: 1em;
        }
        .brand { font-family: georgia, serif; }
        .brand .first {
            color: #ccc;
            font-style: italic;
        }
        .brand .second {
            color: #fff;
            font-weight: bold;
        }
    </style>

  </head>


  <body class=""> 
  <!--<![endif]-->
    
    <div class="navbar">
        <div class="navbar-inner">
                <ul class="nav pull-right">
                    
                    <li><a href="#" class="hidden-phone visible-tablet visible-desktop" role="button">Settings</a></li>
                    <li id="fat-menu" class="dropdown">
                        <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-user"></i> 
							<?php
							
							if(isset($_SESSION['ad_id']))
							{
							$userinfo= User_info($_SESSION['ad_id']);
							
							//print_r()
						 //echo $userinfo->ad_name;
							}
							?>
                            <i class="icon-caret-down"></i>
                        </a>

                        <ul class="dropdown-menu">
                            <li><a tabindex="-1" href="#">My Account</a></li>
                            <li class="divider"></li>
                            <li><a tabindex="-1" class="visible-phone" href="#">Settings</a></li>
                            <li class="divider visible-phone"></li>
                            <li><a tabindex="-1" href="logout.php">Logout</a></li>
                        </ul>
                    </li>
                    
                </ul>
                <a class="brand" href="index.html"><span class="first">Your</span> <span class="second">Company</span></a>
        </div>
    </div>
    


    
    <div class="sidebar-nav">
        <form class="search form-inline">
            <input type="text" placeholder="Search...">
        </form>
        <!-- <a href="menumanager.php"class="nav-header"  ><i class="icon-question-sign"></i>Menu Manager</a>
        <a href="addmodule.php" class="nav-header" ><i class="icon-question-sign"></i>Add Module</a> -->
<a href="#manager-menu" class="nav-header" data-toggle="collapse"><i class="icon-legal"></i>Menu Manager</a>
        <ul id="manager-menu" class="nav nav-list collapse">
            <li ><a href="menumanager.php" >Menu Manager</a></li>
            
        </ul>
        
        <a href="#addmodule-menu" class="nav-header" data-toggle="collapse"><i class="icon-legal"></i>Add Module</a>
        <ul id="addmodule-menu" class="nav nav-list collapse in">
            <li ><a href="addmodule.php" >Add Module</a></li>
            
        </ul>
<?php 
function getoptions()
{
	global $db;
	$tablenames = array("batch_fee", "discount_value", "pre_camp_value","moduledata","menu_table","menu_links","moduleparams","moduletype","hide_video","hide_image","photo_gallery","video_gallery","video_gallery_items_table","video_gallery_type","image_gallery_link","images","other_video_items","seo_detail","component","batch_table","downloads","downloads_type","gallery","answer_table","article_table","article_category","users_table","user_types","sets","set_image","ranking_table","photo_table","video_table","friendlist","field_data","field_reference","menuparams","photo_album","user_destinations","downloads_category","disscussion_table","currency","discount_type","instructor","instructor_type","pre_camp_venue","pre_camp_value","schedule_type","schedule_value","batch_instructer","batch_table","batch_fee","batch_charges_type","tour","country","destination","category","admin_change","tour_country","tour_category","tour_destination","tour_schedule_value","module_menu_position");

foreach ( $db->get_col("SHOW TABLES",0) as $tablename )
{
if (in_array($tablename, $tablenames))
{
	}else{

	?>
 <a href="#<?php echo $tablename; ?>-menu" class="nav-header" data-toggle="collapse"><i class="icon-dashboard"></i><?php echo $tablename; ?></a>
<ul id="<?php echo $tablename; ?>-menu" class="nav nav-list collapse">
            <li ><a href="add.php?type=<?php echo $tablename; ?>&tmpl=default"><?php echo 'Add '.$tablename; ?></a></li>
            <li ><a href="view.php?type=<?php echo $tablename; ?>&tmpl=default"><?php echo 'View all '.$tablename; ?></a></li>
           
            
        </ul>

<?php 
}//else close
}//foreach
	}//function
	
	$a = getoptions();
	echo $a;
?>

        <a href="#accounts-menu" class="nav-header" data-toggle="collapse"><i class="icon-briefcase"></i>Component<span class="label label-info">+3</span></a>
        <ul id="accounts-menu" class="nav nav-list collapse">
            <li ><a href="index.php?option=component&kind=videogallery">Video Gallery</a></li>
            <li ><a href="index.php?option=component&kind=photogallary">Photo Gallery</a></li>
            <li ><a href="index.php?option=component&kind=downloads">Downloads</a></li>
            <li ><a href="index.php?option=component&kind=slideshow">Slideshow</a></li>
            <li ><a href="index.php?option=component&kind=batch">Batch</a></li>
            <li ><a href="index.php?option=component&kind=article_manager">Article Manager</a></li>
            <!-- <li ><a href="index.php?option=component&kind=videogallery&method=gallery&process=add&type=batch_table&id=2&step=1">Reset Password</a></li> -->
        </ul>


        <a href="#legal-menu" class="nav-header" data-toggle="collapse"><i class="icon-legal"></i>Configure</a>
        <ul id="legal-menu" class="nav nav-list collapse">
            <li ><a href="configure.php">Configure View Page</a></li>
            
        </ul>

	
        
      <!--   <a href="index.php?option=component&kind=videogallery&method=config" class="nav-header" ><i class="icon-comment"></i>Add Video config</a>
        <a href="index.php?option=component&kind=photogallary&method=config" class="nav-header" ><i class="icon-comment"></i>Add image config</a>
        <a href="index.php?option=component&kind=videogallery&method=gallery&process=view&id=all" class="nav-header" ><i class="icon-comment"></i>View all Video Gallries</a>
                <a href="index.php?option=component&kind=videogallery&method=items&process=view&id=all" class="nav-header" ><i class="icon-comment"></i>View all Video Items</a>
		<a href="index.php?option=component&kind=photogallary" class="nav-header" ><i class="icon-comment"></i>View all photo galleries</a> -->
    </div>
    
<?php
//include_once('footer.php');
?>