<table>
    <thead>
    <tr> 
        <th>ID</th>
        <th>Transaction Code</th>
        <th>Transaction Item Code</th>
        <!-- <th>Password</th>
        <th>Encrypted</th> -->
    </tr>
    </thead>
    <tbody>
    @foreach($transactionItems as $transactionItem)
        <tr> 
            <td>{{ $transactionItem->id }}</td>
            <td>{{ $transactionItem->transaction_code }}</td>
            <td>{{ $transactionItem->transaction_item_code }}</td> 
        </tr>
    @endforeach
    </tbody>
</table>