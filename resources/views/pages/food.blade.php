@extends('layout.app')

@section('body-content')
<!-- main content start -->
<div class="main-content">
    <div class="container-fluid">

    
        <!-- order list table start -->
        <section class="order-list">
            <div class="row">


                <div class="col-md-7 table-responsive">
					<div class="row mb-1">
						<div class="col-8">
							<ul>
								<li>
									Food List
								</li>
							</ul>
						</div>

						<div class="col-4 text-right">
							<button class="btn-sm btn-primary" data-toggle="modal" data-target="#newFoodItemAdd">New</button>
						</div>


						<!--  add new food Modal -->
						<div class="modal fade" id="newFoodItemAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">New Food</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								</div>
								<div class="modal-body">
									<form action="{{route('AddFood')}}" method="POST">
										@csrf
										<div class="form-group">
											<label for="">Food Name :</label>
											<input type="text" name="name" class="form-control">
										</div>

										<div class="form-group">
											<label for="">Category :</label>
											<select name="category"  class="form-control">
													<option selected disabled>Category</option>
												@foreach ($categories as $category)
													<option value="{{$category->cat_id}}">{{$category->name}}</option>
												@endforeach
											</select>
										</div>

										<div class="form-group">
											<label for="">Price :</label>
											<input type="number" name="price" class="form-control">
										</div>

										<div class="form-group">
											<label for="">Type :</label>
											<select name="type"  class="form-control">
												<option selected disabled>Type</option>
												<option value="veg">Veg</option>
												<option value="non-veg">Not-veg</option>
											</select>
										</div>

										<div class="form-group text-right">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
											<button type="submit" class="btn btn-danger">Save</button>
										</div>
									</form>
								</div>					
							</div>
							</div>
						</div>
					</div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>Name</td>
                                <td>Price</td>
                                <td>Type</td>
                                <td>Category</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
							@foreach (request()->user()->food as $key => $food)
								
							
                            <tr>
                                <th>{{$key + 1}}</th>
                                <td>{{$food->name}}</td>
                                <td>{{$food->price}} tk</td>
                                <td>{{$food->type}}</td>
                                <td>{{$food->category->name}}</td>
                                <td class="action">
                                    <ul>
                                        <li class="edit">
                                            <i class="fas fa-edit" data-toggle="modal" data-target="#editFoodItem{{$food->id}}"></i>
                                        </li>
                                        <li class="delete">
                                            <i class="fas fa-trash" data-toggle="modal" data-target="#deleteFoodItem{{$food->id}}"></i>
                                        </li>
                                    </ul>
                                </td>
							</tr>

							<!--  add new food Modal -->
							<div class="modal fade" id="editFoodItem{{$food->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">New Food</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									</div>
									<div class="modal-body">
										<form action="{{route('editFood', [request()->user()->user_id, $food->id])}}" method="POST">
											@csrf
											<div class="form-group">
												<label for="">Food Name :</label>
												<input type="text" name="name" value="{{$food->name}}" class="form-control">
											</div>

											<div class="form-group">
												<label for="">Category :</label>
												<select name="category"  class="form-control">
														<option disabled>Category</option>
													@foreach ($categories as $category)
														<option @if($category->cat_id == $food->category_id) selected @endif value="{{$category->cat_id}}">{{$category->name}}</option>
													@endforeach
												</select>
											</div>

											<div class="form-group">
												<label for="">Price :</label>
												<input type="number" value="{{$food->price}}" name="price" class="form-control">
											</div>

											<div class="form-group">
												<label for="">Type :</label>
												<select name="type"  class="form-control">
													<option selected disabled>Type</option>
													<option @if($food->type == 'veg') selected @endif value="veg">Veg</option>
													<option @if($food->type == 'non-veg') selected @endif value="non-veg">Not-veg</option>
												</select>
											</div>

											<div class="form-group text-right">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
												<button type="submit" class="btn btn-danger">Save</button>
											</div>
										</form>
									</div>					
								</div>
								</div>
							</div>





							<!--  delete food Modal -->
							<div class="modal fade" id="deleteFoodItem{{$food->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Delete Food?</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									</div>
									<div class="modal-body">
										<form action="{{route('deleteFood', [request()->user()->user_id, $food->id])}}" method="POST">
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








				<div class="col-md-5 table-responsive">
					<div class="row mb-1">
						<div class="col-8">
							<ul>
								<li>
									Category List
								</li>
							</ul>
						</div>

						<div class="col-4 text-right">
							<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#newCategoryModal">New</button>
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
							@foreach ($categories as $key => $category)
								
							
								<tr>
									<th>{{ $key + 1 }}</th>
									<td>{{ $category->name }}</td>
									<td class="action">
										<ul>
											<li class="edit">
												<i class="fas fa-edit" data-toggle="modal" data-target="#editCategoryModal{{$category->id}}"></i>
											</li>
											<li class="delete">
												<i class="fas fa-trash" data-toggle="modal" data-target="#deleteCategoryModal{{$category->id}}"></i>
											</li>
										</ul>
									</td>
								</tr>


								<!-- Edit Modal -->
								<div class="modal fade" id="editCategoryModal{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">New Category</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
										</div>
										<div class="modal-body">
											<form action="{{ route('EditCategory',[Auth::user()->user_id,$category->id ] ) }}" method="POST">
												@csrf
												<div class="form-group">
													<label class="col-form-label">Category Name</label>
													<input type="text" class="form-control" name="name" value="{{$category->name}}">
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
								<div class="modal fade" id="deleteCategoryModal{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Delete Category ?</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
										</div>
										<div class="modal-body">
											<form action="{{ route('deleteCategory',[Auth::user()->user_id,$category->id ] ) }}" method="POST">
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
				<div class="modal fade" id="newCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">New Category</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						</div>
						<div class="modal-body">
							<form action="{{ route('storeCategory') }}" method="POST">
								@csrf
								<div class="form-group">
									<label class="col-form-label">Category Name</label>
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