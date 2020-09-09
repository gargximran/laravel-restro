@extends('layout.app')

@section('body-content')
<!-- main content start -->
<div class="main-content">
    <div class="container-fluid">

    
        <!-- order list table start -->
        <section class="order-list">
            <div class="row">
				<div class="col-md-8 offset-md-2 table-responsive">
					<div class="row mb-1">
						<div class="col-8">
							<ul>
								<li>
									Table List
								</li>
							</ul>
						</div>

						<div class="col-4 text-right">
							<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#newTableModal">New</button>
						</div>
					</div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>Name</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
							@foreach ($tables as $key => $table)
								
							
								<tr>
									<th>{{ $key + 1 }}</th>
									<td>{{ $table->name }}</td>
									<td class="action">
										<ul>
											<li class="edit">
												<i class="fas fa-edit" data-toggle="modal" data-target="#editCategoryModal{{$table->id}}"></i>
											</li>
											<li class="delete">
												<i class="fas fa-trash" data-toggle="modal" data-target="#deleteCategoryModal{{$table->table_id}}"></i>
											</li>
										</ul>
									</td>
								</tr>


								<!-- Edit Modal -->
								<div class="modal fade" id="editCategoryModal{{$table->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">New Table</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
										</div>
										<div class="modal-body">
											<form action="{{ route('update_table', [request()->user()->user_id, $table->id])}}" method="POST">
												@csrf
												<div class="form-group">
													<label class="col-form-label">Category Name</label>
													<input type="text" class="form-control" name="name" value="{{$table->name}}">
												</div>
												<div class="form-group text-right">
													<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
													<button type="submit" class="btn btn-primary">Update</button>
												</div>
											</form>
										</div>					
									</div>
									</div>
								</div>



								<!-- delete Modal -->
								<div class="modal fade" id="deleteCategoryModal{{$table->table_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Delete Category ?</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
										</div>
										<div class="modal-body">
											<form action="{{ route('deleteTable', [Auth::user()->user_id, $table->id])}}" method="POST">
												@csrf
												@method('delete')
												
												<div class="form-group text-right">
													<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
													<button type="submit" class="btn btn-danger">Yes</button>
												</div>
											</form>
										</div>					
									</div>
									</div>
								</div>
							@endforeach
                        </tbody>
                    </table>
				</div>
				
				<!-- Modal -->
				<div class="modal fade" id="newTableModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">New Category</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						</div>
						<div class="modal-body">
							<form action="{{ route('add_table')}}" method="POST">
								@csrf
								<div class="form-group">
									<label class="col-form-label">Table Name</label>
									<input type="text" class="form-control" name="name">
								</div>
								<div class="form-group text-right">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-primary">Save</button>
								</div>
							</form>
						</div>					
					</div>
					</div>
				</div>


            </div>
        </section>
        <!-- order list table end -->
    </div>
</div>
<!-- main content end -->

@endsection