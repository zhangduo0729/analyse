<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3">
                <ul class="list-group">
                    <li class="list-group-item">
                        <a data-toggle="collapse" data-parent="#accordion" href="#one">asdf</a>
                        <ul class="list-group panel-collapse collapse in" id="one">
                            <li class="list-group-item">asdfs</li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="col-md-9">
                <table class="table">
                    <tr>
                        <th>用户名</th>
                        <th>邮箱</th>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
