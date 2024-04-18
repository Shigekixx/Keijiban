const openButton = document.getElementById('openButton');
    const modalDialog = document.getElementById('modalDialog');

    // モーダルを開く
    openButton?.addEventListener('click', async () => {
        modalDialog.removeAttribute("style")

        modalDialog.showModal();
        // モーダルダイアログを表示する際に背景部分がスクロールしないようにする
        document.documentElement.style.overflow = "hidden";
    });

    const closeButton = document.getElementById('closeButton');

    // モーダルを閉じる
    closeButton?.addEventListener('click', () => {
        modalDialog.close();
        // モーダルを解除すると、スクロール可能になる
        document.documentElement.removeAttribute("style");
    });

    modalDialog.addEventListener("close", async(e) => {
        // アニメーションが終了すると、スタイルを適用する
        await waitDialogAnimation(e.target)
        modalDialog.style.display = "none"
    })

    // アニメーションが完了するまで待機する
    const waitDialogAnimation = (dialog) => Promise.allSettled(
        Array.from(dialog.getAnimations()).map(animation => animation.finished)
    );