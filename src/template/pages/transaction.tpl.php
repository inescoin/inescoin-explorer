<div class="card mt-4">
  <div class="card-header">
    <i class="fa fa-exchange" aria-hidden="true"></i> Transaction Information
  </div>
  <div class="card-body">
    <table class="table table-responsive table-striped w-100">
        <tbody>
            <tr>
                <td>Date</td>
                <td class="fixedfont"><?php echo date(DATE_RFC2822, (int)$transaction['createdAt']); ?> - <?php echo $transaction['createdAt']; ?></td>
            </tr>
            <tr>
                <td>From</td>
                <td class="fixedfont">
                    <a href="?wallet=<?php echo $transaction['from'] ?>">
                        <?php echo $transaction['from']; ?>
                    </a>
                </td>
            </tr>
            <tr>
                <td>Hash</td>
                <td class="fixedfont"><?php echo $transaction['hash']; ?></td>
            </tr>
            <tr>
                <td>Signature</td>
                <td class="fixedfont"><small font-><?php echo $transaction['signature']; ?></small></td>
            </tr>
            <tr>
                <td>Height</td>
                <td class="fixedfont">
                    <a href="?block-height=<?php echo $transaction['blockHeight']; ?>">
                        <?php echo $transaction['blockHeight']; ?>
                    </a>
                </td>
            </tr>
            <tr>
                <td>Amount</td>
                <td class="fixedfont"><?php echo ($transaction['amount'] / 1000000000); ?></td>
            </tr>
            <tr>
                <td>Fee</td>
                <td class="fixedfont"><?php echo ($transaction['fee'] / 1000000000); ?></td>
            </tr>
            <tr>
                <td>Config Hash</td>
                <td class="fixedfont"><?php echo $transaction['configHash']; ?></td>
            </tr>
            <tr>
                <td>Coinbase</td>
                <td class="fixedfont"><?php echo !$transaction['coinbase'] ? 'false' : 'true'; ?></td>
            </tr>
            <?php if(!$transaction['coinbase']): ?>
            <tr>
                <td>Public Key</td>
                <td class="fixedfont"><?php echo $transaction['publicKey']; ?></td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
  </div>
</div>
<div class="card mt-4">
  <div class="card-header">
    <i class="fa fa-thumb-tack" aria-hidden="true"></i> Transfers <span class="badge badge-info pull-right"><?php echo count($transaction['transfers']) ?> transfers</span>
  </div>
  <div class="card-body">
    <table class="table table-responsive table-striped w-100">
        <tbody>
            <tr>
                <th>To</th>
                <th>Amount</th>
                <th>Hash</th>
                <th>Nonce</th>
            </tr>
            <?php foreach ($transaction['transfers'] as $transfer): ?>
            <tr>
                <td class="align-center">
                    <a href="?wallet=<?php echo $transfer['to']; ?>">
                        <?php echo $transfer['to']; ?>
                    </a>
                </td>
                <td class="align-center"><?php echo ($transfer['amount'] / 1000000000); ?></td>
                <td class="align-center" title="<?php echo $transfer['hash']; ?>">
                    <a href="?transfer=<?php echo $transfer['hash']; ?>">
                        <div class="truncate"><?php echo $transfer['hash']; ?></div>
                    </a>
                </td>
                <td class="align-center" title="<?php echo $transfer['nonce']; ?>"><div class="truncate"><?php echo $transfer['nonce']; ?></div></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
  </div>
</div>

