import React from 'react';
const Sidebar = (props) => {
    return (
        <aside className="main-sidebar">
            <section className="sidebar">
                <div className="user-panel">
                    <div className="pull-left image">
                        <img src="dist/img/user2-160x160.jpg" className="img-circle" alt="User Image" />
                    </div>
                    <div className="pull-left info">
                        <p>Alexander Pierce</p>
                    </div>
                </div>
                <ul className="sidebar-menu" data-widget="tree">
                    <li className="header">MAIN NAVIGATION</li>
                    <li className="active">
                        <a href="#">
                            <i className="fa fa-dashboard"></i> <span>Dashboard</span>
                            <span className="pull-right-container">
                                <i className="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i className="fa fa-th"></i> <span>Posts</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i className="fa fa-list"></i> <span>Categories</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i className="fa fa-tags"></i> <span>Tags</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i className="fa fa-comments-o"></i> <span>Comments</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i className="fa fa-users"></i> <span>Users</span>
                        </a>
                    </li>
                </ul>
            </section>
        </aside>
    )
};
export default Sidebar;