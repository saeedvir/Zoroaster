<button class="uk-icon delete-one-resource action--delete" resourceId="{{ $data->{$model->getKeyName()} }}">
    <svg width="20" height="20" viewBox="0 0 20 20">
        <path fill-rule="nonzero"
              d="M6 4V2a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2h5a1 1 0 0 1 0 2h-1v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6H1a1 1 0 1 1 0-2h5zM4 6v12h12V6H4zm8-2V2H8v2h4zM8 8a1 1 0 0 1 1 1v6a1 1 0 0 1-2 0V9a1 1 0 0 1 1-1zm4 0a1 1 0 0 1 1 1v6a1 1 0 0 1-2 0V9a1 1 0 0 1 1-1z"></path>
    </svg>
</button>

@if($view == 'Detail')

    <script>

        $(document).ready(function () {

            $(document).on('click', '.delete-one-resource', function () {

                $this = $(this);

                UIkit.modal.confirm(
                    '<h2>حذف رکورد</h2>' +
                    '<h3>شما دارید این رکورد رو حذف می کنید مطمئن هستید</h3>'
                    , {labels: {ok: 'حذف', cancel: 'خیر'}}).then(function () {
                    DestroyOne($this.attr('resourceId'));
                });

            });


        });

        function DestroyOne($resourceId) {
            $destroy_resourceId = $resourceId;


            $.ajax({
                type: 'DELETE',
                url: '{{ route('Zoroaster.resource.destroy',['resource'=> $request->resourceClass ]) }}',
                data: {
                    _token: $('meta[name="_token"]').attr('content'),
                    resourceId: $destroy_resourceId,
                },
                success: function (data) {
                    UIkit.modal.alert('رکورد مورد نظر حذف شد').then(function () {
                        window.location.href='{{ route('Zoroaster.resource.index',['resource'=> $request->resourceClass ]) }}';
                    });

                },
                error: function (data) {



                }
            });
        }


    </script>
@endif