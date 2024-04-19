@extends('layoutAdmin')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <h2>teste</h2>
    <div class="dnd-images">
        <div class="d-flex flex-wrap mb-3 gap-2" id="image-list-1">
            <img class="rounded-circle drag-item cursor-move" src="{{ asset('/public/assets/img/avatars/1.png') }}" alt="avatar-1" height="50" width="50" />
            <img class="rounded-circle drag-item cursor-move" src="{{ asset('/public/assets/img/avatars/2.png') }}" alt="avatar-2" height="50" width="50" />
            <img class="rounded-circle drag-item cursor-move" src="{{ asset('/public/assets/img/avatars/3.png') }}" alt="avatar-3" height="50" width="50" />
            <img class="rounded-circle drag-item cursor-move" src="{{ asset('/public/assets/img/avatars/4.png') }}" alt="avatar-4" height="50" width="50" />
            <img class="rounded-circle drag-item cursor-move" src="{{ asset('/public/assets/img/avatars/5.png') }}" alt="avatar-5" height="50" width="50" />
            <img class="rounded-circle drag-item cursor-move" src="{{ asset('/public/assets/img/avatars/6.png') }}" alt="avatar-6" height="50" width="50" />
        </div>
    </div>
</div>
<script>
const imageList1 = document.getElementById('image-list-1');

Sortable.create(imageList1, {
  animation: 150,
  group: 'imgList',
  onEnd: function (/**Event*/evt) {
		var itemEl = evt.item;  // dragged HTMLElement
        console.log(evt.oldIndex, evt.newIndex);
		//evt.from;  // previous list
		//evt.oldIndex;  // element's old index within old parent
		//evt.newIndex;  // element's new index within new parent
		//evt.oldDraggableIndex; // element's old index within old parent, only counting draggable elements
		//evt.newDraggableIndex; // element's new index within new parent, only counting draggable elements
		//evt.clone // the clone element
		//evt.pullMode;  // when item is in another sortable: `"clone"` if cloning, `true` if moving
	},
});
</script>
@endsection
