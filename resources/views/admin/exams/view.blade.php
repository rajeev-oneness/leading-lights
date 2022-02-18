@extends('admin.layouts.master')

@section('content')
    <div class="dashboard-body" id="content">
        <div class="dashboard-content">
            <div class="row m-0 dashboard-content-header">
                <div class="col-lg-6 d-flex">
                    <a id="sidebarCollapse" href="javascript:void(0);">
                        <i class="fas fa-bars"></i>
                    </a>
                    <ul class="breadcrumb p-0">
                        <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="text-white"><i class="fa fa-chevron-right"></i></li>
                        <li><a href="#" class="active">All exams List</a></li>

                    </ul>
                </div>
                @include('admin.layouts.navbar')
            </div>
            <hr>
            <div class="dashboard-body-content">
                <div class="d-flex justify-content-between align-items-center">
                    <h5>Exams</h5>
                </div>
                <hr>
				<div class="tabs-animation">
					{{-- It restrict user from copy,paste and cut --}}
					{{-- <section class=" " oncopy="return false;" oncut="return false;" onpaste="return false;"
						oncontextmenu="return false;"> --}}
						<div class="card mb-3">
							<div class="card-header qtitle justify-content-center">
								Leading Lights
							</div>
							<div class="row m-0 exam_header align-items-center">
								<div class="col-12 col-lg-4">
									{{-- <ul class="mb-0">
										<li>Date : <b>{{ date('d-M-Y',strtotime($exam->date)) }}</b> </li>
										<li>Student ID : <b>{{ Auth::user()->id_no }}</b></li>
										<li>Student Name : <b>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</b></li>
									</ul> --}}
								</div>
								<div class="col-12 col-lg-4">
									{{-- <h5 class="card-tittle text-center">Class : <b>{{ Auth::user()->class_details->name}}</b></h5> --}}
									<h5 class="card-tittle text-center">Subject : <b>{{ $exam->subject_details->name}}</b></h5>
									<h5 class="card-tittle text-center">Name of exam : <b>{{ $exam->type_of_exam}}</b></h5>
								</div>
								<div class="col-12 col-lg-4 text-right">
									<ul class="mb-0">
									<li>Total Marks : <b>{{ $exam->full_marks }}</b></li>
									<li>Pass Marks : <b>{{ $exam->pass_marks }}</b></li>
								</ul>
								</div>
							</div>
							<!--<div>
								<ul>
									<li>Date: {{ date('d-M-Y',strtotime($exam->date)) }} </li>
									<li>Student ID: {{ Auth::user()->id_no }}</li>
									<li>Student Name: {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</li>
								</ul>
								<ul class="float-right">
									<li>Total Marks: {{ $exam->full_marks }}</li>
									<li>Pass Marks: {{ $exam->pass_marks }}</li>
								</ul>
							</div>-->
							<div class="card-body">
								<p class="text-danger"><small><b>Note:</b> All questions are compulsory.</span>
								@if ($exam->exam_type == 1 && $exam->negative_marks == 1)
									<span>If wrong question selected then 0.25 marks deducted</span>
								@endif
								</p>
								<hr>
								@if ($questions->count() > 0)
									<form action="{{ route('user.exam.start', $exam->id) }}" class="exam_form" method="POST" name="exam"
										id="examForm">
										@csrf
										@foreach ($questions as $key => $question)
											<input type="hidden" name="question_id{{ $key + 1 }}"
												value="{{ $question->id }}">
											<input type="hidden" name="answer{{ $key + 1 }}" value="">
	
	
											<h5>{{ $key + 1 }}. {{ $question->question }}</h5>
											@if ($question->image)
												<div class="pdf-box"
													style="height:100px !important;width: 200px!important">
													<img src="{{ asset($question->image) }}" alt=""
														class="img-fluid rounded  mx-auto w-100 mb-3">
												</div>
											@endif
											@if ($exam->exam_type == 1)
												<ol style="list-style-type: lower-alpha;">
													@foreach ($question->optionData as $option)
														<li><input type="radio" name="answer{{ $key + 1 }}"
																value="{{ $option->option }}" id=""> {{ $option->option }}
														</li>
													@endforeach
												</ol>
											@elseif ($exam->exam_type == 3 && $question->question_type == 1)
												<ol style="list-style-type: lower-alpha;">
													@foreach ($question->optionData as $option)
														<li><input type="radio" name="answer{{ $key + 1 }}"
																value="{{ $option->option }}" id=""> {{ $option->option }}
														</li>
													@endforeach
												</ol>
											@elseif ($exam->exam_type == 2)
											<div class="row">
												@php
													$stored_answer = App\Models\TempExam::where('question_id',$question->id)->where('user_id',Auth::user()->id)->first();
												@endphp
												<div class="col-md-12">
													<div class="form-group">
														<label for="answer"><b>Answer: </b></label>
														@if ($stored_answer)
															<textarea name="answer{{ $key + 1 }}"  cols="3" rows="3" class="form-control" id="answer{{ $key + 1 }}">{{ $stored_answer->answer }}</textarea>
														@else
														  <textarea name="answer{{ $key + 1 }}"  cols="3" rows="3" class="form-control" id="answer{{ $key + 1 }}"></textarea>
														@endif
	
													</div>
												</div>
												<div class="col-md-12">
													<button type="submit" class="btn save_btn" id="save_ans" value="save_ans" name="save_ans" onclick="saveAnswer({{ $exam->id }},{{ $question->id }},{{ $key + 1}})"><i class="fa fa-save"></i> Save</button>
												</div>
											</div>
											@endif
											@if ($exam->exam_type == 3 && $question->question_type == 2)
												<div class="row">
													@php
														$stored_answer = App\Models\TempExam::where('question_id',$question->id)->where('user_id',Auth::user()->id)->first();
													@endphp
													<div class="col-md-12">
														<div class="form-group">
															<label for="answer"><b>Answer: </b></label>
															@if ($stored_answer)
																<textarea name="answer{{ $key + 1 }}"  cols="3" rows="3" class="form-control" id="answer{{ $key + 1 }}">{{ $stored_answer->answer }}</textarea>
															@else
																 <textarea name="answer{{ $key + 1 }}"  cols="3" rows="3" class="form-control" id="answer{{ $key + 1 }}"></textarea>
															@endif
														</div>
													</div>
													<div class="col-md-12">
														<button type="submit" class="btn save_btn" id="save_ans" value="save_ans" name="save_ans" onclick="saveAnswer({{ $exam->id }},{{ $question->id }},{{ $key + 1}})"><i class="fa fa-save"></i> Save</button>
													</div>
												</div>
	
											@endif
											<input type="hidden" name="question_type[]" value="{{ $question->question_type }}">
											<p class="marks_text">Marks: <span>{{ $question->marks }}</span></p>
											<hr>
										@endforeach
										<div class="text-right">
											<input type="hidden" name="index" value="{{ $key + 1 }}">
											<input type="hidden" name="exam_id" value="{{ $exam->id }}">
											<input type="hidden" name="is_user_submitted" value="0" id="is_user_submitted">
	
											<input type="submit" value="submit" class="btn btn-primary submit_btn btn-lg"
											id="btn_submit" name="btn_submit">
										</div>
	
									</form>
								@else
									<h5 class="text-danger">Oops. No data found</h5>
								@endif
	
							</div>
						</div>
	
				</div>
            </div>
        </div>
    </div>
@endsection
