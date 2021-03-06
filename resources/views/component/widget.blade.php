<div class="col-md-4">
    @if($guild ?? '')
    <div class="card mb-4">
        <div class="card-header">Guild</div>
        <div class="card-body">
            <table class="table table-sm">
                <tr>
                    <td><b>Name </b></td>
                    <td>{{ $guild->name }}</td>
                <tr />
                <tr>
                    <td><b>Invite Code </b></td>
                    <td>{{$guild->guild_token}}</td>
                <tr />
            </table>
            {{-- <hr />
            <button class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">Delete</button> --}}
        </div>
    </div>

        @if($quest ?? '')

        <div class="card mb-4">
            <div class="card-header">Quest</div>
            <div class="card-body">
                <table class="table table-sm">
                    <tr>
                        <td><b>Name </b></td>
                        <td>{{ $quest->name }}</td>
                    <tr />
                    <tr>
                        <td><b>Seed </b></td>
                        <td>{{ $quest->dungeon_seed }}</td>
                    <tr />
                    <tr>
                        <td><b>Levels </b></td>
                        <td>{{ $quest->level }}</td>
                    </tr>
                </table>
                <hr />
                <a class='btn btn-primary' href='{{action('QuestController@edit', $quest->id)}}'>Edit</a>
            </div>
        </div>
        @endif

    @endif

    @if($topic ?? '')
    <div class="card mb-4">
        <div class="card-header">Topic</div>
        <div class="card-body">
            <table class="table table-sm">
                <tr>
                    <td><b>Name </b></td>
                    <td>{{ $topic->name }}</td>
                <tr />
                <tr>
                    <td><b>Description </b></td>
                    <td>{{ $topic->description }}</td>
                <tr />
            </table>
            {{-- <hr />
            <button class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">Delete</button> --}}
        </div>
    </div>

        @if($question ?? '')

        <div class="card mb-4">
            <div class="card-header">Question</div>
            <div class="card-body">
                <table class="table table-sm">
                    <tr>
                        <td><b>Question </b></td>
                        <td>{{ $question->question }}</td>
                    <tr />
                </table>
                <hr />
                <a class='btn btn-primary' href='{{action('QuestController@edit', $quest->id)}}'>Edit</a>
            </div>
        </div>
        @endif

    @endif

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                ...
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
          </div>
    </div>
</div>
