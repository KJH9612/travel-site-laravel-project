@if (isset($paginator) && $paginator->lastPage() > 1)

		<ul class="pagination pagination-sm justify-content-center mymargin5">

        <?php
			$interval = isset($interval) ? abs(intval($interval)) : 2 ;
			$from = $paginator->currentPage() - $interval;
			if ($from < 1)	$from = 1;

			$to = $paginator->currentPage() + $interval;
			if ($to > $paginator->lastPage()) $to = $paginator->lastPage();
        ?>

        @if ($paginator->currentPage() > 1)		<!-- 처음, 이전 -->
            <li>
                <a href="{{ $paginator->url(1) }}" aria-label="First">
                    &lt;&lt;
                </a>
            </li>
			&nbsp;&nbsp;
            <li class="page-item">
                <a href="{{ $paginator->url($paginator->currentPage() - 1) }}" aria-label="Previous">
                    &lt;
                </a>
            </li>
			&nbsp;&nbsp;
        @endif

        @for($i = $from; $i <= $to; $i++)				<!--  페이지번호들... -->
            <?php
	            $isCurrentPage = $paginator->currentPage() == $i;
            ?>
            <li class="{{ $isCurrentPage ? 'active' : '' }}">
				@if($isCurrentPage)
                <span>
                    {{ $i }}
                </span>
				@else
				<a href="{{ !$isCurrentPage ? $paginator->url($i) : '#' }}">
                    {{ $i }}
                </a>
				@endif
            </li>
			&nbsp;&nbsp;
        @endfor

        @if($paginator->currentPage() < $paginator->lastPage())	<!-- 다음, 끝 -->
			<li>
                <a href="{{ $paginator->url($paginator->currentPage() + 1) }}" aria-label="Next">
                    &gt;
                </a>
            </li>
			&nbsp;&nbsp;
            <li>
                <a href="{{ $paginator->url($paginator->lastpage()) }}" aria-label="Last">
                    &gt;&gt;
                </a>
            </li>
        @endif

		</ul>

@endif
