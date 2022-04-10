<div class="card mt-4">
  <div class="card-header">
    Block Information
  </div>
  <div class="card-body">
    <table class="table table-responsive table-striped w-100">
        <tbody>
            <tr>
                <td>Height</td>
                <td><?php echo $block['height']; ?></td>
            </tr>
            <tr>
                <td>Hash</td>
                <td><?php echo $block['hash']; ?></td>
            </tr>
            <tr>
                <td>Merkle Root</td>
                <td><?php echo $block['merkleRoot']; ?></td>
            </tr>
            <tr>
                <td>Previous Hash</td>
                <td>
                  <a href="?block-hash=<?php echo $block['previousHash']; ?>">
                    <?php echo $block['previousHash']; ?>
                  </a>
                </td>
            </tr>
            <tr>
                <td>Config Hash</td>
                <td><?php echo $block['configHash']; ?></td>
            </tr>
            <tr>
                <td>Date (Timestamp)</td>
                <td><?php echo date('Y-m-d H:i:s', (int)$block['createdAt']); ?> - <?php echo $block['createdAt']; ?></td>
            </tr>
            <tr>
                <td>Nonce</td>
                <td><?php echo $block['nonce']; ?></td>
            </tr>
            <tr>
                <td>Difficulty</td>
                <td><?php echo $block['difficulty']; ?></td>
            </tr>
            <tr>
                <td>Cumulative Difficulty</td>
                <td><?php echo $block['cumulativeDifficulty']; ?></td>
            </tr>
        </tbody>
    </table>
  </div>
</div>

<div class="card mt-4">
  <div class="card-header">
    Transactions <span class="badge badge-info"><?php echo count($block['data']) ?></span>
  </div>
  <div class="card-body">
    <table class="table table-responsive table-striped w-100">
        <tbody>
          <tr>
            <th>Height</th>
            <th>Amount</th>
            <th>Fee</th>
            <th>Hash</th>
            <th>From</th>
            <th>Coinbase</th>
          </tr>
          <?php foreach ($block['data'] as $transaction): ?>
            <tr>
              <td class="align-center">
              <?php echo $block['height']; ?>
              </td>
              <td class="align-center"><?php echo ($transaction['amount'] / 1000000000); ?></td>
              <td class="align-center"><?php echo ($transaction['fee'] / 1000000000); ?></td>
              <td class="align-center">
                <a href="?transaction=<?php echo $transaction['hash']; ?>">
                  <div class="truncate"><?php echo $transaction['hash']; ?></div>
                </a>
              </td>
              <td class="align-center">
                <a href="?wallet=<?php echo $transaction['fromWalletId']; ?>">
                  <?php echo $transaction['fromWalletId']; ?>
                </a>
              </td>
              <td class="align-center"><?php echo !$transaction['coinbase'] ? 'false' : 'true'; ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
    </table>
  </div>
</div>

