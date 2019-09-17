<div class="card mt-4">
    <div class="card-header">
        <i class="fa fa-suitcase" aria-hidden="true"></i> Wallet Information
    </div>
    <div class="card-body">
        <table class="table table-responsive table-striped w-100">
            <tbody>
                <tr>
                    <td>Address</td>
                    <td><?php echo $wallet['address']; ?></td>
                </tr>
                <tr>
                    <td>Balance</td>
                    <td><?php echo ($wallet['amount'] / 1000000000); ?> INES</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="card mt-4">
  <div class="card-header">
    <i class="fa fa-exchange" aria-hidden="true"></i> Transaction Pool <span class="badge badge-info pull-right"><?php echo isset($wallet['transfersPool']['total']) ? $wallet['transfersPool']['total'] : '0' ?> transactions</span>
  </div>
  <div class="card-body">
    <?php if (isset($wallet['transfersPool']['total']) && $wallet['transfersPool']['total']): ?>
    <table class="table table-responsive table-striped w-100">
        <tbody>
            <tr>
                <th class="text-center">From</th>
                <th class="text-center">Type</th>
                <th class="text-center">Amount</th>
                <th class="text-center">Fee</th>
                <th class="text-center">Hash</th>
            </tr>
            <?php foreach ($wallet['transfersPool']['transactions'] as $transaction): ?>
            <tr>
                <td class="text-center">
                    <a href="?wallet=<?php echo $transaction['from']; ?>">
                        <?php echo $transaction['from']; ?>
                    </a>
                </td>
                <td class="text-center"><span class="badge badge-<?php echo $wallet['address'] === $transaction['from'] ? 'danger' : 'success' ?>"><?php echo $wallet['address'] === $transaction['from'] ? 'output' : 'input' ?></span></td>
                <td class="text-center"><?php echo $wallet['address'] === $transaction['from'] ? '-' : '+' ?><?php echo ($transaction['amount'] / 1000000000); ?></td>
                <td class="text-center"><?php echo ($transaction['fee'] / 1000000000); ?></td>
                <td class="text-center">
                    <div class="truncate"><?php echo $transaction['hash']; ?></div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
  </div>
</div>


<div class="card mt-4">
  <div class="card-header">
    <i class="fa fa-exchange" aria-hidden="true"></i> Transaction <?php echo $wallet['transfers']['total']; ?> transactions
  </div>
  <div class="card-body">
    <?php if(!empty($wallet['transfers']['transactions'])): ?>
    <ul class="pagination justify-content-center">
        <li class="page-item">
          <a class="page-link" href="/?wallet=<?php echo $wallet['address'] ?>&page=<?php echo $pagination['previous'] ?>">Previous</a>
        </li>
        <li class="page-item">
          <a class="page-link" href="/?wallet=<?php echo $wallet['address'] ?>&page=<?php echo $pagination['next'] ?>">Next</a>
        </li>
    </ul>
    <table class="table table-responsive table-striped w-100">
        <tbody>
            <tr>
                <th class="text-center">Height</th>
                <th class="text-center">Type</th>
                <th class="text-center">Amount</th>
                <th class="text-center">Transfer Hash</th>
                <th class="text-center">Tansaction Hash</th>
                <th class="text-center">From</th>
                <th class="text-center">To</th>
            </tr>
            <?php foreach ($wallet['transfers']['transactions'] as $transfer): ?>
            <tr>
                <td class="text-center">
                    <a href="?block-height=<?php echo $transfer['height'] ?>">
                        <?php echo $transfer['height'] ?>
                    </a>
                </td>
                <td class="text-center"><span class="badge badge-<?php echo $wallet['address'] === $transfer['from'] ? 'danger' : 'success' ?>"><?php echo $wallet['address'] === $transfer['from'] ? 'output' : 'input' ?></span></td>
                <td class="text-center"><?php echo $wallet['address'] === $transfer['from'] ? '-' : '+' ?><?php echo ($transfer['amount'] / 1000000000) ?></td>
                <td class="text-center">
                    <div class="truncate"><?php echo $transfer['hash'] ?></div>
                </td>
                <td class="text-center">
                    <a href="?transaction=<?php echo $transfer['transactionHash'] ?>">
                        <div class="truncate"><?php echo $transfer['transactionHash'] ?></div>
                    </a>
                </td>
                <td class="text-center">
                    <a href="?wallet=<?php echo $transfer['from'] ?>">
                        <div <?php if ($transfer['from'] !== 'inescoin') { echo 'class="truncate"'; } ?> ><?php echo $transfer['from'] ?></div>
                    </a>
                </td>
                <td class="text-center">
                    <a  href="?wallet=<?php echo $transfer['to'] ?>">
                       <div class="truncate"><?php echo $transfer['to'] ?></div>
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <ul class="pagination justify-content-center">
        <li class="page-item">
          <a class="page-link" href="/?wallet=<?php echo $wallet['address'] ?>&page=<?php echo $pagination['previous'] ?>">Previous</a>
        </li>
        <li class="page-item">
          <a class="page-link" href="/?wallet=<?php echo $wallet['address'] ?>&page=<?php echo $pagination['next'] ?>">Next</a>
        </li>
    </ul>
    <?php else: ?>
        <p>Not yet.</p>
    <?php endif; ?>
  </div>
</div>
