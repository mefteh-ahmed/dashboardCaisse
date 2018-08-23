<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset("/bower_components/AdminLTE/dist/img/useravatar.jpg") }}" class="img-circle"
                     alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name}}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> connecté</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <!-- Optionally, you can add icons to the links -->

            <li class="active"><a href="/"><i class="fa fa-link"></i> <span>Dashboard</span></a></li>

               <li class="nav-item ">
      <a href="{{ route('chaine.index') }}"><i class="fa fa-glass"></i> <span> Chaine de Magasin </span></a>
                                </li>
               <li class="nav-item ">
      <a href="{{ route('magasin.index') }}"><i class="fa fa-glass"></i> <span> Magasins </span></a>
                                </li>
                              
            <li class="nav-item "><a href="{{ route('clientASM.index') }}"><i class="fa fa-group"></i> <span>Client ASM</span></a>
            </li>
       
 
    <li class="nav-item ">
      <a href="{{ route('magasinDB.index') }}"><i class="fa fa-glass"></i> <span> BaseConfigMagasin </span></a>
                                </li>
    
   
  
        <!-- /.sidebar-menu -->
        
    </section>
    <!-- /.sidebar -->
</aside>


