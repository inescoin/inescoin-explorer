<?php if (isset($wallet['wallet']['address'])) { ?>
<div class="card mt-4">
    <div class="card-header">
        <i class="fa fa-suitcase" aria-hidden="true"></i> Wallet Information
    </div>
    <div class="card-body">
        <table class="table table-responsive table-striped w-100">
            <tbody>
                <tr>
                    <td>Address</td>
                    <td><?php echo $wallet['wallet']['address']; ?></td>
                </tr>
                <tr>
                    <td>Balance</td>
                    <td><?php echo ($wallet['wallet']['amount'] / 1000000000); ?> INES</td>
                </tr>
                <tr>
                    <td>Block Height</td>
                    <td><?php echo $wallet['wallet']['height']; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<?php if (isset($wallet['transfersPool']['total']) && $wallet['transfersPool']['total']): ?>
<div class="card mt-4">
  <div class="card-header">
    <i class="fa fa-exchange" aria-hidden="true"></i> Transaction Pool <span class="badge badge-info pull-right"><?php echo isset($wallet['transfersPool']['total']) ? $wallet['transfersPool']['total'] : '0' ?> transactions</span>
  </div>
  <div class="card-body">
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
                    <a href="?wallet=<?php echo $transaction['fromWalletId']; ?>">
                        <?php echo $transaction['fromWalletId']; ?>
                    </a>
                </td>
                <td class="text-center"><span class="badge badge-<?php echo $wallet['wallet']['address'] === $transaction['fromWalletId'] ? 'danger' : 'success' ?>"><?php echo $wallet['wallet']['address'] === $transaction['fromWalletId'] ? 'output' : 'input' ?></span></td>
                <td class="text-center"><?php echo $wallet['wallet']['address'] === $transaction['fromWalletId'] ? '-' : '+' ?><?php echo ($transaction['amount'] / 1000000000); ?></td>
                <td class="text-center"><?php if (isset($transaction['fee'])) { echo ($transaction['fee'] / 1000000000); } ?></td>
                <td class="text-center">
                    <div class="truncate"><?php echo $transaction['hash']; ?></div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
  </div>
</div>
<?php endif; ?>

<ul class="nav nav-tabs nav-justified mt-4 mb-4" role="tablist">
  <li class="nav-item">
      <a class="nav-link active" href="#transactions" role="tab" data-toggle="tab"><i class="fa fa-exchange" aria-hidden="true"></i> Transaction <span class="badge badge-info"><?php echo $wallet['count']; ?></span></a>
  </li>
  <li class="nav-item">
      <a class="nav-link" href="#domains" role="tab" data-toggle="tab"><i class="fa fa-list" aria-hidden="true"></i> Domains <span class="badge badge-info"><?php echo (empty($wallet['domains']) ? '0' : $wallet['countDomains']); ?></span></a>
  </li>
</ul>

<div class="tab-content">
  <div role="tabpanel" class="tab-pane fade show active" id="transactions">
    <div class="card mt-4"  style="border: none;">
      <div class="card-body">
        <?php if(!empty($wallet['transfers'])): ?>
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
                <?php foreach ($wallet['transfers'] as $transfer): ?>
                <tr>
                    <td class="text-center">
                        <a href="?block-height=<?php echo $transfer['height'] ?>">
                            <?php echo $transfer['height'] ?>
                        </a>
                    </td>
                    <td class="text-center"><span class="badge badge-<?php echo $wallet['wallet']['address'] === $transfer['fromWalletId'] ? 'danger' : 'success' ?>"><?php echo $wallet['wallet']['address'] === $transfer['fromWalletId'] ? 'output' : 'input' ?></span></td>
                    <td class="text-center"><?php echo $wallet['wallet']['address'] === $transfer['fromWalletId'] ? '-' : '+' ?><?php echo ($transfer['amount'] / 1000000000) ?></td>
                    <td class="text-center">
                        <div class="truncate"><?php echo $transfer['hash'] ?></div>
                    </td>
                    <td class="text-center">
                        <a href="?transaction=<?php echo $transfer['transactionHash'] ?>">
                            <div class="truncate"><?php echo $transfer['transactionHash'] ?></div>
                        </a>
                    </td>
                    <td class="text-center">
                        <a href="?wallet=<?php echo $transfer['fromWalletId'] ?>">
                            <div <?php if ($transfer['fromWalletId'] !== 'inescoin') { echo 'class="truncate"'; } ?> ><?php echo $transfer['fromWalletId'] ?></div>
                        </a>
                    </td>
                    <td class="text-center">
                        <a  href="?wallet=<?php echo $transfer['toWalletId'] ?>">
                           <div class="truncate"><?php echo $transfer['toWalletId'] ?></div>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php else: ?>
            <p>Not yet.</p>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <div role="tabpanel" class="tab-pane fade" id="domains">
    <div class="card mt-4"  style="border: none;">
      <div class="card-body">
        <?php if(!empty($wallet['domains'])): ?>
        <table class="table table-responsive table-striped w-100">
            <tbody>
                <tr>
                    <th class="text-center">Name</th>
                    <th class="text-center">Block Height</th>
                    <th class="text-center">Hash</th>
                    <th class="text-center">Transaction hash</th>
                </tr>
                <?php foreach ($wallet['domains'] as $domain): ?>
                <tr>
                    <td class="text-center">
                        <a href="?domain=<?php echo $domain['url'] ?>">
                            <?php echo $domain['url'] ?>
                        </a>
                    </td>
                    <td class="text-center">
                        <a href="?block-height=<?php echo $domain['height'] ?>">
                            <?php echo $domain['height'] ?>
                        </a>
                    </td>
                    <td class="text-center">
                        <div class="txt-300 text-wrap"><?php echo $domain['hash'] ?></div>
                    </td>

                    <td class="text-center">
                        <a href="?transaction=<?php echo $domain['transactionHash'] ?>">
                            <div class="txt-300 text-wrap"><?php echo $domain['transactionHash'] ?></div>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php else: ?>
            <p>Not yet.</p>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
<?php } else { ?>
<div class="alert alert-danger text-center mt-4">
    <i class="fa fa-exclamation-triangle"></i> Wallet not found.
</div>
<?php } ?>
