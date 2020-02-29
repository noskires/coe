<table>
    <thead>
    <tr> 
        <th>ID</th>
        <th>Transaction Code</th>
        <th>Transaction Desc</th>
        <!-- <th>Password</th>
        <th>Encrypted</th> -->
    </tr>
    </thead>
    <tbody>
    @foreach($transactions as $transaction)
        <tr> 
            <td>{{ $transaction->id }}</td>
            <td>{{ $transaction->transaction_code }}</td>
            <td>{{ $transaction->transaction_desc }}</td> 
        </tr>
    @endforeach
    </tbody>
</table>