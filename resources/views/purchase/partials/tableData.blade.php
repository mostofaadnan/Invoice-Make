
         <?php $i = 1; ?>
            @foreach($purchases as $purchase)
            <tr>
                <td align="center">{{ $i++ }}
                </td>
                <td align="center">{{ $purchase->purchasecode }}</td>
                <td >{{ $purchase->SupplierName->name }}</td>
                <td align="center">{{ $purchase->inputdate }}</td>
                <td class="amount" align="right">{{ $purchase->amount }}</td>
                <td class="totaldiscount" align="right">{{ $purchase->discount }}</td>
                <td  class="vat" align="right">{{ $purchase->vat }} </td>
                <td  class="nettotal" align="right">{{ $purchase->nettotal }}</td>
                <td>
                    <?php

                    if ($purchase->status == 0) { ?>
                       <!--  <button class="btn btn-danger" id="active" data-id="{{ $purchase->id}}">Inactive</button> -->
                       Inactive

                    <?php  } else {  ?>

                       <!--  <button class="btn btn-info" id="inactive" data-id="{{ $purchase->id}}">Active</button> -->
                       Active

                    <?php } ?>
                </td>
                
                <td align="right">{{$purchase->user_id}}</td>
              
                <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a type="button" class="btn btn-outline-info btn-sm" href="{{route('purchase.show', $purchase->id )}}">View</i></a>
                        <a type="button" class="btn btn-outline-primary btn-sm" href="{{route('purchase.edit', $purchase->id)}}">Edit</i></a>
                        <a type="button" class="btn btn-outline-danger btn-sm" id="deletedata" data-id="{{ $purchase->id}}">Delete</a>
                      
                    </div>
                </td>
            </tr>
            @endforeach
        